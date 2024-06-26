<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubjectMap;
use App\Models\LayerMap;
use Response;
use DB;
// use App\Http\Models\SubCategory;

class CategoryController extends Controller
{
    public function index() {
        try{
            $categories=Category::where('category.level', 1)
            ->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->orderBy('number_oder', 'asc')->get();
            return View('admin.setcategory.indexCategory',compact('categories'));
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    //addmin
    public function loadParentCategory() {
        try{
            $categories=Category::select('category.id', 'category.name', 'category.is_block', 'category.number_oder', 'category.level', 'category.code', 'category.parent_id', 'category.created_at', 'category.updated_at')
            ->where('category.level', 1)
            ->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->orderBy('number_oder', 'asc')->get();
            return Response::json(['data'=>$categories], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function editCategory($id) {
        try{
            if (is_numeric($id) || $id > 0) {
                $categories = Category::where('level', 1)->orderBy('number_oder', 'asc')->get();
                $inforcategory=Category::select('category.id', 'category.name', 'category.is_block', 'category.number_oder', 'category.level', 'category.code', 'category.parent_id', 'category.created_at', 'category.updated_at')
                ->leftJoin('category as t', 'category.parent_id', '=', 't.id')
                ->selectRaw('t.name as parent_name')
                ->where('category.id', '=', $id)
                ->where(function($query) {
                    $query->whereNull('category.is_delete')
                        ->orWhere('category.is_delete', false);
                })->first();
                if($inforcategory==null)
                    return redirect()->route('index.category')->with('errors', 'Lỗi không tìm thấy danh mục');
                    return view('admin.setcategory.editCategory',compact('inforcategory','categories'));
            }else {
                return redirect()->route('index.category')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroyCategory(Request $request,$id=null)
    {
        // Find the user by ID
        try{
            if($id)
            {
                $categoriesChild= Category::where('parent_id',$id)->orwhere('id',$id)->update([
                    'is_delete'=>true,
                ]);
                
                $destroyMaps=Subjectmap::leftJoin('category', 'subjectmap.category_id', '=', 'category.id')->where('parent_id',$id)->orwhere('id',$id)->get();
                foreach ($destroyMaps as $destroyMap) {
                     $destroyMap->is_delete=true; // Display category name (you can format this as needed)
                     $destroyMap->save();
                     $destroyLayerMap=LayerMap::where('subjectmap_id',(int)$destroyMap->id)->update([
                        'is_delete'=>true,
                    ]);
                }
                return response()->json(['success' => 1]);
            }else{
                return response()->json(['success' => null]);
            }
            // return response()->json(['success' => 1]);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function loadCategory(Request $request) {
        try{
            $request->validate([
                'find_name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'choose_category' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $choose_category= $findname='%'.$request->choose_category.'%';
            $findname='%'.$request->find_name.'%';
            if(($request->choose_category)!=null)
            { 
                $categories=Category::select('category.id', 'category.name', 'category.is_block', 'category.number_oder', 'category.level', 'category.code', 'category.parent_id', 'category.created_at', 'category.updated_at')
                ->leftJoin('category as t', 'category.parent_id', '=', 't.id')
                ->selectRaw('t.name as parent_name')
                ->where('category.name', 'ilike', $findname)
                ->where('category.parent_id', 'ilike', $choose_category)
                ->where(function($query) {
                    $query->whereNull('category.is_delete')
                        ->orWhere('category.is_delete', false);
                })->orderBy('number_oder', 'asc')
                ->get();
            }else{
                $categories=Category::select('category.id', 'category.name', 'category.is_block', 'category.number_oder', 'category.level', 'category.code', 'category.parent_id', 'category.created_at', 'category.updated_at')
                ->leftJoin('category as t', 'category.parent_id', '=', 't.id')->selectRaw('t.name as parent_name')
                ->where('category.name', 'ilike', $findname)->orderBy('number_oder', 'asc')
                ->where(function($query) {
                    $query->whereNull('category.is_delete')
                        ->orWhere('category.is_delete', false);
                })->get();
            }
            return Response::json(['data'=>$categories], 200);
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
            $categories = Category::where('level', 1)->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            return View('admin.setcategory.createCategory',compact('categories'));
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function saveCategory(Request $request) {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'number' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'code' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'level' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'parent' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $category = new Category();

            $category->name = (string)$request->name;
            $category->is_block = $request->is_block;
            $category->number_oder = (int)$request->number;
            $category->level = (int)$request->level;
            $category->code = (string)$request->code;
            if((int)$request->parent==null)
            {
                $category->parent_id = null;
            }
            else 
            {
                $category->parent_id = (int)$request->parent;
            }
            $category->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function updateCategory(Request $request,$id)
    {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'number' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'code' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'level' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'parent' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $category = Category::findOrFail((int)$id);
            $category->update([
                'name'=>(string)$request->name,
                'is_block'=>$request->is_block,
                'number_oder'=>(int)$request->number,
                'level'=>(int)$request->level,
                'code'=>(string)$request->code,
                'parent_id'=>($request->parent==null)?null:(int)$request->parent,
            ]);
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    
}
