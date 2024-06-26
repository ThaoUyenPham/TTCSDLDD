<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjectmap;
use App\Models\LayerMap;
use App\Models\Category;
use App\Models\SystemGeo;
use App\Models\District;
use App\Models\NativeSRS;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Response;
use DB;
use Auth;

use GuzzleHttp\Client;

class MapsController extends Controller
{
    public function loadMapClient(Request $request)  {

        $subjectmaps = Subjectmap::select(
            'subjectmap.id',
            'subjectmap.name',
            'subjectmap.year',
            'subjectmap.thumbnail',
            'subjectmap.district_id',
            'subjectmap.category_id',
            'subjectmap.expri_date',
            'subjectmap.level',
            'd.valueX',
            'd.valueY',
            'd.zoomm',
            'd.ma_dvhc'
        )
        ->leftJoin('district as d', 'subjectmap.district_id', '=', 'd.id')
        ->where(function($query) {
            $query->whereNull('subjectmap.is_delete')
                ->orWhere('subjectmap.is_delete', false);
        })
        ->where(function($query) {
            $query->whereNull('subjectmap.is_block')
                ->orWhere('subjectmap.is_block', false);
        })
        ->whereIn('subjectmap.id',$request->id) // Corrected to use an array
        ->get();
        // $subjectmaps=Subjectmap::select('subjectmap.id','subjectmap.name','subjectmap.year','subjectmap.thumbnail',
        // 'subjectmap.district_id','subjectmap.category_id','subjectmap.expri_date','subjectmap.level')
        // ->leftJoin('district as d', 'subjectmap.district_id', '=', 'district.id')
        // ->selectRaw('district.valueX, district.valueY, district.zoomm')
        // ->where(function($query) {
        //     $query->whereNull('subjectmap.is_delete')
        //         ->orWhere('subjectmap.is_delete', false);
        // })->where(function($query) {
        //     $query->whereNull('subjectmap.is_block')
        //         ->orWhere('subjectmap.is_block', false);
        // })
        // ->whereIn('subjectmap.id', $request->id)->get(); 

        for ($i=0; $i < count($subjectmaps); $i++) { 
            $layerMap=LayerMap::select('layermap.id', 'layermap.name','layermap.lable', 'layermap.is_block','layermap.is_nen','layermap.default')
            ->where(function($query) {
                $query->whereNull('layermap.is_delete')
                ->orWhere('layermap.is_delete', false);
            })->leftJoin('systemgeo as s', 'layermap.systemgeo_id', '=', 's.id')
            ->selectRaw('s.linkUrl as linkUrl,s.workspace')
            ->leftJoin('nativesrs as n', 'layermap.nativesrs_id', '=', 'n.id')
            ->selectRaw('n.auth_name as nameSRS,n.proj4text')->where('layermap.subjectmap_id',$subjectmaps[$i]->id)->get();
            $subjectmaps[$i]['layer']=$layerMap;
        }
        return Response::json(['data'=>$subjectmaps]);
    }
    public function loadMapArrayClient(Request $request)  {
        $subjectmaps=Subjectmap::where(function($query) {
            $query->whereNull('subjectmap.is_delete')
                ->orWhere('subjectmap.is_delete', false);
        })->whereIn('id', $request->id)->get();
        for ($i=0; $i < count($subjectmaps); $i++) { 
            $layerMap=LayerMap::select('layermap.id', 'layermap.name','layermap.lable','layermap.is_block')
            ->where(function($query) {
            $query->whereNull('layermap.is_delete')
                ->orWhere('layermap.is_delete', false);
            })->leftJoin('systemgeo as s', 'layermap.systemgeo_id', '=', 's.id')
            ->selectRaw('s.linkUrl as linkUrl,s.workspace')
            ->leftJoin('nativesrs as n', 'layermap.nativesrs_id', '=', 'n.id')
            ->selectRaw('n.auth_name as nameSRS,n.proj4text')->where('layermap.subjectmap_id',$request->id)->get();
            $subjectmaps[$i]['layer']=$layerMap;
        }
        return Response::json(['data'=>$subjectmaps]);
    }
    public function index()  {
        $categories=Category::where('category.level', 1)
        ->where(function($query) {
            $query->whereNull('is_block')
                ->orWhere('is_block', false);
        })->where(function($query) {
            $query->whereNull('is_delete')
                ->orWhere('is_delete', false);
        })->get();
        for ($i=0; $i < count($categories); $i++) { 
            $categories[$i]['children']=Category::where('category.level', 2)
            ->where(function($query) {
                $query->whereNull('is_block')
                    ->orWhere('is_block', false);
            })->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->where('parent_id', $categories[$i]->id)->get();
        }
        $districts = District::where('ma_dvhc_cha','ilike','%/82/%')->get();
        return view('admin.setmap.indexMap',compact('categories','districts'));
    }
    public function loadMap(Request $request)  {
        try{
            $chooseCategory="%%";
            if($request->chooseCategory!=null&&$request->chooseCategory!="")
            {
                $chooseCategory=$request->chooseCategory;
            }

            $findYear="%%";

            if($request->findYear!=null&&$request->findYear!="")
            {
                $findYear=$request->findYear;
            }

            $findName='%'.$request->findName.'%';

            $chooseDistrict="%%";

            if($request->chooseDistrict!=null&&$request->chooseDistrict!="")
            {
                $chooseDistrict=$request->chooseDistrict;
            }
            $chooseLevel='%'.$request->chooseLevel.'%';

            $subjectmaps=Subjectmap::select('subjectmap.id','subjectmap.name','subjectmap.thumbnail','subjectmap.year','subjectmap.level','subjectmap.summary')
            ->leftJoin('category', 'subjectmap.category_id', '=', 'category.id')
            ->selectRaw('category.name as categoryName')
            ->where('subjectmap.name', 'ilike',$findName)
            ->where('subjectmap.year', 'ilike',$findYear)
            ->where('subjectmap.level', 'ilike',$chooseLevel)
            ->where('subjectmap.district_id', 'ilike',$chooseDistrict)
            ->leftJoin('district as a', 'subjectmap.district_id', '=', 'a.id')
            ->selectRaw('"tenDVHC" as districtName')
            ->where(function($query) use ($chooseCategory) {
                $query->where('subjectmap.category_id', 'ilike',$chooseCategory)
                ->orwhere('category.parent_id', 'ilike', $chooseCategory);
            })
            ->where(function($query) {
                $query->whereNull('subjectmap.is_delete')
                    ->orWhere('subjectmap.is_delete', false);
            })->get();
            return Response::json(['data'=>$subjectmaps], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function loadGeoServer(Request $request)  {
        try{
            $idGeoServer=$request->id;
            $systemgeos = SystemGeo::where('id',$idGeoServer)->first();
            $client = new Client();
            $response = $client->request('GET', $systemgeos->linkurl."/rest/workspaces/".$systemgeos->workspace."/featuretypes.json", [
                'auth' => ['admin', '123']
            ]);
            $layers = json_decode($response->getBody(), true);
                //  return response()->json(['data'=>$layers]);
            return response()->json(['data'=>$layers['featureTypes']['featureType']]);
        }catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function createMap()  {
        try{
            $nativeSRS = NativeSRS::get();
            $categories=Category::where('category.level', 1)
            ->where(function($query) {
                $query->whereNull('is_block')
                    ->orWhere('is_block', false);
            })->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            for ($i=0; $i < count($categories); $i++) { 
                $categories[$i]['children']=Category::where('category.level', 2)
                ->where(function($query) {
                    $query->whereNull('is_block')
                        ->orWhere('is_block', false);
                })->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })->where('parent_id', $categories[$i]->id)->get();
            }
            $systemgeos = SystemGeo::where('is_delete','<>',true)->orwhereNull('is_delete')->get();
            $districts = District::where('ma_dvhc_cha','ilike','%/82/%')->get();
            return view('admin.setmap.createMap',compact('categories','districts','systemgeos','nativeSRS'));
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function editMap($id=null)  {
        try{ 
            if($id){
                $nativeSRS = NativeSRS::get();
                $categories=Category::where('category.level', 1)
                ->where(function($query) {
                    $query->whereNull('is_block')
                        ->orWhere('is_block', false);
                })->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })->get();
                for ($i=0; $i < count($categories); $i++) { 
                    $categories[$i]['children']=Category::where('category.level', 2)
                    ->where(function($query) {
                        $query->whereNull('is_block')
                            ->orWhere('is_block', false);
                    })->where(function($query) {
                        $query->whereNull('is_delete')
                            ->orWhere('is_delete', false);
                    })->where('parent_id', $categories[$i]->id)->get();
                }
                $systemgeos = SystemGeo::where('is_delete','<>',true)->orwhereNull('is_delete')->get();
                $districts = District::where('ma_dvhc_cha','ilike','%/82/%')->get();
                if (is_numeric($id) || $id > 0) {
                    $inforSubjectMap=Subjectmap::where('id', (int)$id)
                    ->where(function($query) {
                        $query->whereNull('is_delete')
                            ->orWhere('is_delete', false);
                    })->first();
                    $listLayerMaps=LayerMap::where('subjectmap_id', (int)$id)
                    ->where(function($query) {
                        $query->whereNull('is_delete')
                            ->orWhere('is_delete', false);
                    })->orderBy('number_oder', 'asc')->get();
                    if($inforSubjectMap==null)
                        return redirect()->route('index.map')->with('errors', 'Lỗi không tìm thấy danh mục');
                        return view('admin.setmap.editMap',compact('categories','districts','systemgeos','inforSubjectMap','listLayerMaps','nativeSRS'));
                }else {
                    return redirect()->route('index.map')->with('errors', 'Lỗi không tìm thấy danh mục');
                }
            }else{
                return redirect()->route('index.map')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }  
    }
    public function destroyMap($id=null){
        if($id)
        {
            try{ 
                $destroyMap=Subjectmap::where('id',(int)$id)->update([
                    'is_delete'=>true,
                ]);
                $success=LayerMap::where('subjectmap_id',(int)$id)->update([
                        'is_delete'=>true,
                    ]);
                return response()->json(['success' => 1]);
            } catch (QueryException $e) {
                // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
                return response()->json(['error' => 'Database error: '.$e->getMessage()]);
            } catch (Exception $e) {
                // Xử lý các lỗi khác không phải lỗi SQL3 
                return response()->json(['error' => 'Error: '.$e->getMessage()]);
            }  
        }else{
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }

    }
    public function destroyLayerMap(Request $request)  {
        try{ 
            $success=LayerMap::where('id', (int)$request->id)->update([
                    'is_delete'=>true,
                ]);
            return response()->json(['success' => $success]);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }  
    }
    public function saveMap(Request $request)  {
        try{
            if (is_null($request->layer)) {
                return response()->json(['error' => 'No data received'], 400);
            }
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max :4048',
            ]);
            $newName="";
            if ($request->file('image')) {
                $image = $request->file('image');
                $newName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $newName, 'public');
            }
            // Lưu thông tin hình ảnh vào cơ sở dữ liệu
            $subjectmap = new Subjectmap();
            $subjectmap->thumbnail = $newName;
            $subjectmap->name=$request->name;
            $subjectmap->summary=$request->summary;
            $subjectmap->is_block=$request->is_block;
            // $subjectmap->srs=$request->srs;
            // $subjectmap->bbox=$request->bbox;
            $subjectmap->year=$request->year;
            // $subjectmap->zoomin=$request->zoomin;
            $subjectmap->level=$request->level;
            $subjectmap->create_date=$request->create_date;
            $subjectmap->active_date=$request->active_date;
            $subjectmap->expri_date=$request->expri_date;
            $subjectmap->discription=$request->discription;
            $subjectmap->category_id=$request->category_id;
            $subjectmap->district_id=$request->district_id;
            $subjectmap->note=$request->note;
            $subjectmap->save();
            $id = $subjectmap->id;
            if($request->layer!=null)
            {
                $data = json_decode($request->layer, true);
                for ($i=0; $i < count($data); $i++) { 
                    $layerMap = new LayerMap();
                    $layerMap->is_nen = (boolean)$data[$i][5];
                    $layerMap->default = (boolean)$data[$i][4];
                    $layerMap->name = (string)$data[$i][3];
                    $layerMap->subjectmap_id = $id;
                    $layerMap->nativesrs_id = (int)$data[$i][2];
                    $layerMap->systemgeo_id = (int)$data[$i][1];
                    $layerMap->lable = (string)$data[$i][0];
                    $layerMap->number_oder=$i;
                    $layerMap->save();
                }
            }
            return response()->json(['success' =>  1]);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }  
    }
    public function updateMap(Request $request,$id)  {
        try{
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max :4048',
            ]);
            // // Lưu thông tin hình ảnh vào cơ sở dữ liệ
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'level' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'year' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                // 'zoomin' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'active_date' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'expri_date' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'category_id' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'district_id' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'note' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $activeDate = $request->active_date ? Carbon::parse($request->active_date) : null;
            $expriDate = $request->expri_date ? Carbon::parse($request->expri_date) : null;
            $subjectmap = SubjectMap::findOrFail((int)$id);
            if ($request->file('image')) {
                if (Storage::disk('public')->exists('images/'.$subjectmap->thumbnail)) {
                    Storage::disk('public')->delete('images/'.$subjectmap->thumbnail);
                }
                $image = $request->file('image');
                $newName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $newName, 'public');
                $subjectmap->update([
                    'name'=>(string)$request->name,
                    'is_block'=>$request->is_block,
                    'summary'=>(string)$request->summary,
                    'level'=>(int)$request->level,
                    // 'srs'=>(string)$request->srs,
                    // 'bbox'=>(string)$request->bbox,
                    'year'=>(string)$request->year,
                    // 'zoomin'=>(float)$request->zoomin,
                    'active_date'=>$activeDate,
                    'expri_date'=>$expriDate,
                    'updated_at'=>now(),
                    'discription'=>(string)$request->discription,
                    'category_id'=>(int)$request->category_id,
                    'district_id'=>(int)$request->district_id,
                    'note'=>(string)$request->note,
                    'thumbnail'=>$newName,
                ]);
                if($request->layer!=null)
                {
                    $data = json_decode($request->layer, true);
                    
                    for ($i=0; $i < count($data); $i++) { 
                        if((int)$data[$i][0]==null||(string)$data[$i][0]=='')
                        {
                            $layerMap = new LayerMap();
                            $layerMap->is_nen = (boolean)$data[$i][6];
                            $layerMap->default = (boolean)$data[$i][5];
                            $layerMap->name = (string)$data[$i][4];
                            $layerMap->subjectmap_id = $id;
                            $layerMap->nativesrs_id = (string)$data[$i][3];
                            $layerMap->systemgeo_id = (int)$data[$i][2];
                            $layerMap->lable = (string)$data[$i][1];
                            $layerMap->number_oder = $i;
                            $layerMap->save();
                        }else{
                            $layerMap = LayerMap::findOrFail((int)$data[$i][0]);
                            $layerMap->update([
                                'srs'=>(string)$data[$i][3],
                                'lable'=>(string)$data[$i][1],
                                'number_oder'=>($i+1),
                                'is_nen'=>(boolean)$data[$i][6],
                                'default'=> (boolean)$data[$i][5],
                            ]);
                        }
                    }
                }
            }else{
                $subjectmap->update([
                    'name'=>(string)$request->name,
                    'is_block'=>$request->is_block,
                    'summary'=>(string)$request->summary,
                    'level'=>(int)$request->level,
                    'year'=>(string)$request->year,
                    // 'zoomin'=>(float)$request->zoomin,
                    'active_date'=>$activeDate,
                    'expri_date'=>$expriDate,
                    'updated_at'=>now(),
                    'discription'=>(string)$request->discription,
                    'category_id'=>(int)$request->category_id,
                    'district_id'=>(int)$request->district_id,
                    'note'=>(string)$request->note,
                ]);
                if($request->layer!=null)
                {
                    $data = json_decode($request->layer, true);
                    
                    for ($i=0; $i < count($data); $i++) { 
                        if((int)$data[$i][0]==null||(string)$data[$i][0]=='')
                        {
                            $layerMap = new LayerMap();
                            $layerMap->is_nen = (boolean)$data[$i][6];
                            $layerMap->default = (boolean)$data[$i][5];
                            $layerMap->name = (string)$data[$i][4];
                            $layerMap->subjectmap_id = $id;
                            $layerMap->nativesrs_id = (string)$data[$i][3];
                            $layerMap->systemgeo_id = (int)$data[$i][2];
                            $layerMap->lable = (string)$data[$i][1];
                            $layerMap->number_oder = $i;
                            $layerMap->save();
                        }else{
                            $layerMap = LayerMap::findOrFail((int)$data[$i][0]);
                            $layerMap->update([
                                'srs'=>(string)$data[$i][3],
                                'lable'=>(string)$data[$i][1],
                                'number_oder'=>($i+1),
                                'is_nen'=>(boolean)$data[$i][6],
                                'default'=> (boolean)$data[$i][5],
                            ]);
                        }
                    }
                }
            }
            return response()->json(['success' =>  '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }  
    }
    public function test(Request $request)
    {
        return Response::json(["data"=>$request->all()]);
    }
// Show data Client
    public function detailsCategoryMap($id = null){   
        $districts = District::where('ma_dvhc_cha','ilike','%/82/%')->get();
        if (is_numeric($id) || $id > 0) {
            $idCategory=$id;
            return view('clients.map.index',compact('districts','idCategory'));
        }else{
            return redirect()->route('home')->with('errors', 'Lỗi không tìm thấy bản đồ');;
        }
    } 
    public function map($id = null)  {
        if ($id) {
            // $categories = Category::where('is_delete','<>',true)->orwhereNull('category.is_delete')->get();
            $districts = District::where('ma_dvhc_cha','ilike','%/82/%')->get();
            // $subjectListMaps=Subjectmap::where(function($query) {
            //     $query->whereNull('subjectmap.is_delete')
            //         ->orWhere('subjectmap.is_delete', false);
            // })->get();
            $subjectmap=Subjectmap::where(function($query) {
                $query->whereNull('subjectmap.is_delete')
                    ->orWhere('subjectmap.is_delete', false);
            })->where(function($query) {
                $query->whereNull('subjectmap.is_block')
                    ->orWhere('subjectmap.is_block', false);
            })->where('id',$id)->first();
            if($subjectmap==null)
            {
                return redirect()->route('home')->with('errors', 'Lỗi không tìm bản đồ');
            }
            return view('clients.map.map', compact('subjectmap','districts'));
        }else{
            return redirect()->route('home')->with('errors', 'Lỗi không tìm bản đồ');
        }
    }
    public function loadMapCategory(Request $request)  {
        try{
            $chooseCategory="%%";
            if($request->chooseCategory!=null&&$request->chooseCategory!="")
            {
                $chooseCategory=$request->chooseCategory;
            }

            $findYear=[];

            if($request->findYear!=null&&$request->findYear!="")
            {
                $findYear = $request->findYear;
            }

            $findName='%'.$request->findName.'%';

            $chooseDistrict="%%";

            if($request->chooseDistrict!=null&&$request->chooseDistrict!="")
            {
                $chooseDistrict=$request->chooseDistrict;
            }
            $chooseLevel='%'.$request->chooseLevel.'%';

            $subjectmaps=Subjectmap::select('subjectmap.id','subjectmap.name','subjectmap.thumbnail','subjectmap.year','subjectmap.level','subjectmap.summary')
            ->leftJoin('category', 'subjectmap.category_id', '=', 'category.id')
            ->where('subjectmap.name', 'ilike',$findName)
            ->when($findYear, function($query, $findYear) {
                return $query->whereIn('subjectmap.year', $findYear);
            })
            ->where('subjectmap.level', 'ilike',$chooseLevel)
            ->where('subjectmap.district_id', 'ilike',$chooseDistrict)
            // ->where('subjectmap.category_id', 'ilike',$chooseCategory)
            ->where(function($query) use ($chooseCategory) {
                $query->where('subjectmap.category_id', 'ilike',$chooseCategory)
                ->orwhere('category.parent_id', 'ilike', $chooseCategory);
            })
            ->where(function($query) {
                $query->whereNull('subjectmap.is_block')
                    ->orWhere('subjectmap.is_block', false);
            })
            ->where(function($query) {
                $query->whereNull('subjectmap.is_delete')
                    ->orWhere('subjectmap.is_delete', false);
            })->get();
            return Response::json(['data'=>$subjectmaps,'request'=>$findYear], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }

}
