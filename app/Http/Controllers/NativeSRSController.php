<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NativeSRS;
use GuzzleHttp\Client;
use Response;
use DB;
use Auth;

class NativeSRSController extends Controller
{
    public function index()  {
        return view('admin.setnativesrs.indexNativeSRS');
    }
    public function loadNativeSRS(Request $request)  {
        try{
            $request->validate([
                'find_name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $findname='%'.$request->find_name.'%';
            $nativesrs=NativeSRS::where('auth_name', 'ilike', $findname)->get();
            return Response::json(['data'=>$nativesrs],200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }     
    }
    public function editNativeSRS($id)  {
        if (is_numeric($id) || $id > 0) {
            $inforNativeSRS=NativeSRS::where('id',$id)->first();
            if($inforNativeSRS==null)
                return redirect()->route('index.nativeSRS')->with('errors', 'Lỗi không tìm thấy nativeSRS');
                return view('admin.setnativesrs.editNativeSRS',compact('inforNativeSRS'));
        }else {
            return redirect()->route('index.nativeSRS')->with('errors', 'Lỗi không tìm thấy nativeSRS');
        }
    }
    public function saveNativeSRS(Request $request)  {
        
        try{
            $request->validate([
    
            ]);
            $nativeSRS = new NativeSRS();
            $nativeSRS->auth_name = (string)$request->auth_name;
            $nativeSRS->auth_srid = (int)$request->auth_srid;
            $nativeSRS->proj4text = (string)$request->proj4text;
            $nativeSRS->srtext = (string)$request->srtext;
            $nativeSRS->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }     
    }
    public function updateNativeSRS(Request $request,$id)  {
        try{
            $request->validate([
                
            ]);
            $nativeSRS = NativeSRS::findOrFail((int)$id);
            $nativeSRS->update([
                'auth_name'=>(string)$request->auth_name,
                'auth_srid'=>(int)$request->auth_srid,
                'proj4text'=>(string)$request->proj4text,
                'srtext'=>(string)$request->srtext,
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
    public function destroyNativeSRS($id)  {
        try{
            $nativeSRS = NativeSRS::find($id);

            if ($nativeSRS) {
                // Delete the item
                $nativeSRS->delete();
                
                // Optionally return a response
                return response()->json(['message' => '1'], 200);
            } else {
                // Item not found
                return response()->json(['message' => 'Item not found'], 404);
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }     
    }
    
    public function createNativeSRS()  {

        return view('admin.setnativesrs.createNativeSRS');
    }
    public function convertCORS(Request $request)
    {
        if(Auth::check())
        {
            if($request->url)
            {
                $client = new Client();
                $response = $client->request('GET',$request->url, [
                    // 'auth' => ['admin', '123']
                ]);
                $layers = json_decode($response->getBody(), true);
                return response()->json(['data'=>$layers['features']]);
            }else{
                return response()->json(["errors"=>"null"]);
            }
        }else{
            return response()->json(["errors"=>"1"]);
        }
    }
}
