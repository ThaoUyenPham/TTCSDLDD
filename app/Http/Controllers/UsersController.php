<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Security;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\ListPermission;
use App\Models\User;
use Illuminate\Support\Str;
use Session;
use DB;
use Auth;
use Response;
// use DB;

class UsersController extends Controller
{
    public function indexAdmin(){
        return view('admin.setusers.indexUsers');
    }
    public function loadUsersAdmin()
    {
        try{
            $users=User::where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            return Response::json(['data'=>$users], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function createUsers(){
        $permissions=Security::where('is_delete','<>',true)->orwhereNull('is_delete')->get();
        return view('admin.setusers.createUsers',compact('permissions'));
    }
    public function saveUsers(Request $request){
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $user = new User();
            $user->name = (string)$request->name;
            $user->is_block = $request->is_block;
            $user->username = (string)$request->username;
            $user->phone = (string)$request->phone;
            $user->company = (string)$request->company;
            $user->email = (string)$request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $id = $user->id;
            if($request->permission!=null)
            {
                if (is_array($request->permission)) {
                    $request->permission = json_encode($request->permission);
                }
                $data = json_decode($request->permission, true);
                for ($i=0; $i <count($data) ; $i++) { 
                    if((int)$data[$i][0]==null||(string)$data[$i][0]=='')
                    {
                        $listpermission = new ListPermission();
                        $listpermission->security_id=$data[$i][1];
                        $listpermission->user_id=$id;
                        $listpermission->save();
                    }
                } 
            }
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function siginClient()  {
        return view("login");   
    }
    public function login(Request $request)  {

        $inputlogin= [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($inputlogin)) {
            $request->session()->regenerate();
            $listpermission=$this->getListPermission(Auth::user()->id);
            if(count($listpermission)>0)
            {
                foreach($listpermission as $itemRole)
                {
                    if($itemRole['codesecurity']=='admin'||$itemRole['codesecurity']=='super'){
                 
                        return redirect()->route('admin');
                    };
                }
                return redirect()->route('home');
            }else{
                return redirect()->route('login')->with('error', 'Tài khoản này chưa được cấp quyền sử dụng hệ thống.');
            }
        }else{
            return redirect()->route('login')->with('error', 'Tên người dùng hoặc mật khẩu không đúng.');
        }
    }
    public function logout(Request $request)  {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('login');

    }
    public function editUsers( $id=null){
        try{
            if($id)
            {
                if (is_numeric($id) || $id > 0) {
                    $permissions=Security::where('is_delete','<>',true)->orwhereNull('is_delete')->get();
                    $inforUsers=User::where('id', $id)->where(function($query) {
                        $query->whereNull('is_delete')
                            ->orWhere('is_delete', false);
                    })
                    ->first();
                    $permissionUsers=ListPermission::select('listpermission.id','user_id','security_id','active_date','expri_date')
                    ->leftJoin('security as s', 'listpermission.security_id', '=', 's.id')
                    ->selectRaw('s.name as namesecurity, s.code as codesecurity')->where('user_id',$id)->get();
                    if($inforUsers==null)
                        return redirect()->route('index.users')->with('errors', 'Lỗi không tìm thấy thông tin');
                        return view('admin.setusers.editUsers',compact('inforUsers','permissionUsers','permissions'));
                }else {
                    return redirect()->route('index.user')->with('errors', 'Lỗi không tìm thấy thông tin');
                }
            }else{
                return redirect()->route('index.user')->with('errors', 'Lỗi không tìm thấy thông tin');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroyUser( $id=null){
        try{
            if($id)
            {
                if (is_numeric($id) || $id > 0) {
                    $inforUsers=User::where('id', $id)->where(function($query) {
                        $query->whereNull('is_delete')
                            ->orWhere('is_delete', false);
                    })
                    ->first();
                    if($inforUsers==null)
                        return redirect()->route('index.users')->with('errors', 'Lỗi không tìm thấy thông tin');
                        return view('admin.setusers.editUsers',compact('inforUsers'));
                }else {
                    return redirect()->route('index.user')->with('errors', 'Lỗi không tìm thấy thông tin');
                }
            }else{
                return redirect()->route('index.user')->with('errors', 'Lỗi không tìm thấy thông tin');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function updateUsers(Request $request, $id=null){
        if($id)
        {
            try{
                $request->validate([
                    'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                ]);
                $updateUsers = User::findOrFail((int)$id);
                $updateUsers->update([
                    'name'=>(string)$request->name,
                    'is_block'=>$request->is_block,
                    'phone'=>(string)$request->phone,
                    'company'=>(string)$request->company,
                    'email' => (string)$request->email,
                ]);
                
                if($request->permission!=null)
                {
                    if (is_array($request->permission)) {
                        $request->permission = json_encode($request->permission);
                    }
                    $data = json_decode($request->permission, true);
                    for ($i=0; $i <count($data) ; $i++) { 
                        if((int)$data[$i][0]==null||(string)$data[$i][0]=='')
                        {
                            $listpermission = new ListPermission();
                            $listpermission->security_id=$data[$i][1];
                            $listpermission->user_id=$id;
                            $listpermission->save();
                        }
                    } 
                }
                return response()->json(['success' => '1']);
            } catch (QueryException $e) {
                // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
                return response()->json(['error' => 'Database error: '.$e->getMessage()]);
            } catch (Exception $e) {
                // Xử lý các lỗi khác không phải lỗi SQL3 
                return response()->json(['error' => 'Error: '.$e->getMessage()]);
            }
        }else{
            return response()->json(['success' => '2']);
        }
    }
    public function checkIsset(Request $request)  {
        try{
            if($request->username)
            {
                $returnuser=User::where('username',$request->username)->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })->get();
                if ($returnuser) {
                    // Nếu người dùng được tìm thấy, thực hiện các hành động cần thiết
                    return Response::json(['success'=>null], 200);
                } else {
                    // Nếu không tìm thấy người dùng, bạn có thể xử lý thông báo hoặc redirect người dùng đến một trang khác
                    return Response::json(['success'=>1], 200);
                }
            }else{
                return Response::json(['success'=>null], 200);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function resetUsers($id=null)  {
        try{
            if($id)
            {
                $password = Str::random(5); // Hoặc sử dụng generateRandomPassword(12);
                $updateUsers = User::findOrFail((int)$id);
                $updateUsers->update([
                    'password'=>$password
                ]);
                if ($updateUsers) {
                    return Response::json(['success'=>1,'password'=>$password], 200);
                    // Nếu người dùng được tìm thấy, thực hiện các hành động cần thiết
                } else {
                    // Nếu không tìm thấy người dùng, bạn có thể xử lý thông báo hoặc redirect người dùng đến một trang khác
                    return Response::json(['success'=>null], 200);
                }
            }else{
                return Response::json(['success'=>null], 200);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function viewChangePasswordAdmin()
    {
        return view("admin.user.changepassword");
    }
    public function viewAccountAdmin()
    {
        try{
            $inforUser = User::where('id',(int)Auth::id())->first();
            return view("admin.user.inforaccount", compact('inforUser'));
        }
        catch (QueryException $e) {
        // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
             return rediect()->route('notfound');
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return rediect()->route('notfound');
        }
    }

/// user client
    public function viewChangePasswordClient()
    {
        return view("clients.user.changepassword");
    }
    public function viewAccountClient()
    {
        try{
            $inforUser = User::where('id',(int)Auth::id())->first();
            return view("clients.user.changeaccount", compact('inforUser'));
        }
        catch (QueryException $e) {
        // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
             return rediect()->route('notfound');
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return rediect()->route('notfound');
        }
    }
    public function changeAccountClient(Request $request)
    {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $updateUsers = User::findOrFail((int)Auth::id());
            $updateUsers->update([
                'name'=>(string)$request->name,
                'phone'=>(string)$request->phone,
                'company'=>(string)$request->company,
                'email' => (string)$request->email,
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
    public function changePasswordClient(Request $request)
    {
        try{
            if (!Hash::check($request->currentPassword, Auth::user()->password)) {
                return response()->json(['success' => '3']);
            }
            // Cập nhật mật khẩu mới
            $user = Auth::user();
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function getListPermission()  {
        if(Auth::check())
        {
            $listpermission= ListPermission::select('listpermission.id',"listpermission.active_date","listpermission.expri_date")
            ->leftJoin('security as s', 'listpermission.security_id', '=', 's.id')
            ->selectRaw('s.code as codesecurity, s.name as namesecurity')
            ->where('user_id', Auth::user()->id)->get();
            return $listpermission;
        } 
        return response()->json(["error"=>"1"]);
     }
}
