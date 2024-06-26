<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ListPermission;
use App\Models\Security;
use App\Models\User;
use Illuminate\Support\Str;
use Session;
use DB;
use Auth;
use Response;

class ListPermissionController extends Controller
{
    public function loadPermissionUser($user_id=null)
    {
        if($user_id)
        {
            try{
                $listpermissions=ListPermission::where('user_id',$user_id)->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })->get();
                return Response::json(['data'=>$listpermissions], 200);
            } catch (QueryException $e) {
                // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
                return response()->json(['error' => 'Database error: '.$e->getMessage()]);
            } catch (Exception $e) {
                // Xử lý các lỗi khác không phải lỗi SQL3 
                return response()->json(['error' => 'Error: '.$e->getMessage()]);
            }
        }else{
            return response()->json(['data' =>null ]);
        }
    }
    public function saveList(Request $request)
    {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $listpermission = new ListPermission();
            $listpermission->name = (string)$request->name;
            $listpermission->is_block = $request->is_block;
            $listpermission->username = (string)$request->username;
            $listpermission->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function deletelist(Request $request)
    {
        if($request->id)
        {
            try{
                $deleteListPerimission = ListPermission::destroy($request->id);
            //     $listpermissions=ListPermission::where('user_id',$user_id)->where(function($query) {
            //         $query->whereNull('is_delete')
            //             ->orWhere('is_delete', false);
            //     })->get();
                 return Response::json(['data'=>$deleteListPerimission,'success'=>1], 200);
            } catch (QueryException $e) {
                // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
                return response()->json(['error' => 'Database error: '.$e->getMessage()]);
            } catch (Exception $e) {
                // Xử lý các lỗi khác không phải lỗi SQL3 
                return response()->json(['error' => 'Error: '.$e->getMessage()]);
            }
        }else{
            return response()->json(['data' =>null ]);
        }
    }
}
