<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Security;
use Response;
use DB;

class PermissionController extends Controller
{
    public function index()  {
        return view('admin.setpermission.indexPermission');
    }
    public function createPermission()  {
        return view('admin.setpermission.createPermission');
    }
    public function savePermission(Request $request)  {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'code' =>['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $security = new Security();
            $security->name = (string)$request->name;
            $security->is_block = $request->is_block;
            $security->code = (string)$request->code;
            $security->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function loadPermission() {
        try{
            $securitys=Security::where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            return Response::json(['data'=>$securitys], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function editPermission($id=null)
    {
        try{
            if($id)
            {
                if (is_numeric($id) || $id > 0) {
                    $inforPermission=Security::where('id', $id)->where(function($query) {
                        $query->whereNull('is_delete')
                            ->orWhere('is_delete', false);
                    })
                    ->first();
                    if($inforPermission==null)
                        return redirect()->route('index.permission')->with('errors', 'Lỗi không tìm thấy danh mục');
                        return view('admin.setpermission.editPermission',compact('inforPermission'));
                }else {
                    return redirect()->route('index.permission')->with('errors', 'Lỗi không tìm thấy danh mục');
                }
            }else{
                return redirect()->route('index.permission')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function updatePermission(Request $request,$id=null){
        try{
            if($id)
            {
                $request->validate([
                    'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                    'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                ]);
                $permissions = Security::findOrFail((int)$id);
                $permissions->update([
                    'name'=>(string)$request->name,
                    'is_block'=>$request->is_block,
                    'code'=>(string)$request->code,
                ]);
                // return Response::json($request);
                return response()->json(['success' => '1']);
            }else{
                return response()->json(['success' => '2']);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroyPermission($id=null){
        try{
            if($id)
            {
                $permissions=Security::where('id', (int)$id)
                ->update([
                    'is_delete'=>true,
                ]);
                
                return response()->json(['success' => $permissions]);
            }else{
                return response()->json(['success' => '2']);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
}
