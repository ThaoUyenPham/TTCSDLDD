<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjectmap;
use App\Models\Contact;
use App\Models\Category;
use DB;



class HomesController extends Controller
{
    public function index()  {
        $categories=Category::where('category.level', 1)
        ->where(function($query) {
            $query->whereNull('is_delete')
                ->orWhere('is_delete', false);
        })->where(function($query) {
            $query->whereNull('is_block')
                ->orWhere('is_block', false);
        })->get();
        // $dataMap;
        $dataMap2;

        for ($i=0; $i < count($categories); $i++) {
            $bientam= $categories[$i]->id;
            // $sd=0;
            $dataMap2[$bientam]= $this->getLatestSubjectMapsByCategory( $bientam);
            // $bientam= $categories[$i]->id;
            // $categories2=Category::where('parent_id', $bientam )->orwhere('id',$bientam)->get();
            // for ($j=0; $j <count($categories2); $j++) { 
            //     Subjectmap::select('year')->where('category_id',$categories2->id)->orderBy('year', 'desc')->first();
            //     $dataMap[$bientam][$sd]=
            //     $sd++;
            // }
            // $dataMap[$bientam]=
            // Subjectmap::select('subjectmap.id', 'subjectmap.name', 'subjectmap.summary', 
            // 'subjectmap.number_oder', 'subjectmap.level', 'subjectmap.discription', 'subjectmap.year',
            //  'subjectmap.thumbnail')
            // ->leftJoin('category as c', 'subjectmap.category_id', '=', 'c.id')
            // ->where(function($query) use ($bientam) {
            //     $query->where('subjectmap.category_id',$bientam)
            //     ->orWhere('c.parent_id',$bientam);
            // })
            // ->where(function($query) {
            //     $query->whereNull('subjectmap.is_delete')
            //         ->orWhere('subjectmap.is_delete', false);
            // })->where(function($query) {
            //     $query->whereNull('subjectmap.is_block')
            //         ->orWhere('subjectmap.is_block', false);
            // })->get();
        }
      
        // $code=Auth;
        return view("clients.home.index", compact('categories','dataMap2'));
    }
    public function admin()  {
        $years = DB::table('subjectmap')
        ->select('year')
        ->distinct()
        ->orderBy('year', 'asc')
        ->get();
        $tong=SubjectMap::count();
        $mailCount = contact::where('active',false)->count('id');

        return view("admin.home.index",compact('mailCount','tong','years'));
    }
    public function getLatestSubjectMapsByCategory($parentId)
    {
        // Step 1: Retrieve the category tree
        $categoryTree = Category::where('id', $parentId)
            ->orWhere('parent_id', $parentId)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        // Step 2: Find the latest year for each category
        $latestYears = SubjectMap::select('category_id', DB::raw('MAX(year) as latest_year'))
            ->whereIn('category_id', $categoryTree)
            ->groupBy('category_id')
            ->pluck('latest_year', 'category_id');

        // Step 3: Retrieve the subject maps with the latest year for each category
        $subjectMaps = SubjectMap::whereIn('category_id', $categoryTree)
            ->where(function($query) use ($latestYears) {
                foreach ($latestYears as $categoryId => $year) {
                    $query->orWhere(function($query) use ($categoryId, $year) {
                        $query->where('category_id', $categoryId)
                              ->where('year', $year);
                    });
                }
            })->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })
            ->get();

        return $subjectMaps;
    }
    public function pieChart($year=null)
    { 
        try 
        {   if($year)
            {
                $data = SubjectMap::selectRaw('COALESCE(pc.name, c.name) as category_name, COUNT(subjectmap.id) as number_of_maps')
                ->join('category as c', 'subjectmap.category_id', '=', 'c.id')
                ->leftJoin('category as pc', 'c.parent_id', '=', 'pc.id')
                ->where('subjectmap.year', $year)
                ->groupBy('category_name')
                ->orderBy('category_name')
                ->get();
            }else{
                $data = SubjectMap::selectRaw('COALESCE(pc.name, c.name) as category_name, COUNT(subjectmap.id) as number_of_maps')
                ->join('category as c', 'subjectmap.category_id', '=', 'c.id')
                ->leftJoin('category as pc', 'c.parent_id', '=', 'pc.id')
                ->groupBy('category_name')
                ->orderBy('category_name')
                ->get();
            }
            // Kiểm tra nếu $year không có giá trị được chọn từ form
          
            return response()->json($data);
            // Trả về dữ liệu dưới dạng JSON
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function columnChart()  
    {
         $countofyear=SubjectMap::select('year', DB::raw('COUNT(id) as number_of_ids'))
        ->groupBy('year')
        ->orderBy('year')
        ->get();
        return response()->json($countofyear);
    }
    
}
