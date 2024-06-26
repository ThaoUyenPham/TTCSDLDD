<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ads;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Response;
use Auth;

class AdsController extends Controller
{
    // public 
    function index() {
        try{
            return View('admin.setads.indexAds');
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function loadAds(Request $request) {
        try{
            $findname="%%";
            $request->validate([
                'find_name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            if($request->find_name)
            {
                $findname='%'.$request->find_name.'%';
            }
            $ads=ads::where('name','ilike',$findname)->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
                    
            })->orderBy('number_oder', 'asc')->get();
            return Response::json(['data'=>$ads], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function create() {
        try{
            return View('admin.setads.createAds');
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function editAds($id=null) {
        try{
            if ($id) {
                $inforads=ads::find($id);
                if($inforads==null)
                    return redirect()->route('index.ads.admin')->with('errors', 'Lỗi không tìm thấy danh mục');
                    return view('admin.setads.editAds',compact('inforads'));
            }else {
                return redirect()->route('index.ads.admin')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function saveAds(Request $request) {
         try{
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max :2048',
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'number' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'code' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);  
            $newName="";
            if ($request->file('image')) {
                $image = $request->file('image');
                $newName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $newName, 'public');
            }
            $ads = new ads();    
            $ads->name = (string)$request->name;    
            $ads->thumbnail = $newName;        
            $ads->is_block = $request->has('is_block');
            $ads->number_oder = (int)$request->number;
            $ads->link = $request->link;
            $ads->code = (string)$request->code;
            $ads->save();
           return response()->json(['success' => '1']);

        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function updateAds(Request $request,$id=null)
    {
        try{
            if($id){
                $request->validate([
                    'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                    'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                    'number' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                    'code' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max :2048',
                ]);
                $ads = Ads::FindorFail((int)$id);
                if ($request->file('image')) {
                    if (Storage::disk('public')->exists('images/'.$ads->thumbnail)) {
                        Storage::disk('public')->delete('images/'.$ads->thumbnail);
                    }
                    $image = $request->file('image');
                    $newName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('images', $newName, 'public');
                    $ads->update([
                        'name'=>(string)$request->name,
                        'is_block'=>$request->is_block,
                        'link'=>$request->link,
                        'number_oder'=>(int)$request->number,
                        'code'=>(string)$request->code,
                        'thumbnail'=>$newName,
                    ]);
                }
                else{
                    $ads->update([
                        'name'=>(string)$request->name,
                        'is_block'=>$request->is_block,
                        'link'=>$request->link,
                        'number_oder'=>(int)$request->number,
                        'code'=>(string)$request->code,
                    ]);
                }
                
                return response()->json(['success' => 1]);
            }else{
                return response()->json(['success' => 2]);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroyAds($id=null)
    {
        // Find the user by ID
        try{
            if($id)
            {
                $ad=ads::where('id',$id)->first()
                ->update([
                   'is_delete' => true,
               ]);
               return response()->json(['success' => $ad]);  
            }else{
                return response()->json(['success' => 2]);
            }
            // danh muc con
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    
}
