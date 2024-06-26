<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemGeo;
use Response;
use DB;

class SystemGeoController extends Controller
{
    public function index()  {
        return view('admin.setsystemgeo.indexsystemgeo');
    }
    public function loadSystemGeo(Request $request) {
        try{
            $find_name= $findname='%'.$request->find_name.'%';
            $systemgeos=SystemGeo::where('name', 'ilike', $find_name)->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            return Response::json(['data'=>$systemgeos], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function create() {
        return view('admin.setsystemgeo.createsystemgeo');
    }
    public function checkIsset(Request $request)  {
        try{
            $linkUrl= $findname='%'.$request->linkUrl.'%';
            $systemgeos=SystemGeo::where('linkurl', '=', $linkUrl)->where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            if ($systemgeos) {
                // Nếu người dùng được tìm thấy, thực hiện các hành động cần thiết
                return Response::json(['data'=>null], 200);
            } else {
                // Nếu không tìm thấy người dùng, bạn có thể xử lý thông báo hoặc redirect người dùng đến một trang khác
                return Response::json(['data'=>1], 200);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function saveSystemGeo(Request $request) {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'number_oder' =>['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'default' =>['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'username' =>['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'password' =>['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $systemGeo = new SystemGeo();
            $systemGeo->name = (string)$request->name;
            $systemGeo->is_block = $request->is_block;
            $systemGeo->number_oder = (int)$request->number_oder;
            $systemGeo->linkurl = (string)$request->linkUrl;
            $systemGeo->default = $request->default;
            $systemGeo->workspace = (string)$request->workspace;
            $systemGeo->username = (string)$request->username;
            $systemGeo->password = (string)$request->password;
            $systemGeo->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function editSystemGeo($id) {
        try{
            if (is_numeric($id) || $id > 0) {
                $inforSystemGeo=SystemGeo::where('id', '=', $id)->where('id', $id)->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })
                ->first();
                if($inforSystemGeo==null)
                    return redirect()->route('index.systemgeo')->with('errors', 'Lỗi không tìm thấy danh mục');
                    return view('admin.setsystemgeo.editSystemGeo',compact('inforSystemGeo'));
            }else {
                return redirect()->route('index.systemgeo')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function updateSystemGeo(Request $request,$id)
    {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'number_oder' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'default' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                // 'workspace' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                // 'username' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                // 'password' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $systemGeo = SystemGeo::findOrFail((int)$id);
            $systemGeo->update([
                'name'=>(string)$request->name,
                'is_block'=>$request->is_block,
                'number_oder'=>(int)$request->number_oder,
                'default'=>$request->default,
                'linkurl'=>(string)$request->linkurl,
                'workspace' => (string)$request->workspace,
                'username' => (string)$request->username,
                'password' => (string)$request->password,
            ]);
            // return Response::json($request);
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroySystemGeo(Request $request,$id)
    {
        // Find the user by ID
        try{
            // danh muc con
                $systemGeo=SystemGeo::where('id', (int)$id)
                ->update([
                    'is_delete'=>true,
                ]);
            return response()->json(['success' => $systemGeo]);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
}
