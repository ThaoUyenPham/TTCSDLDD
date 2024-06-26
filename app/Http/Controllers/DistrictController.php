<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use DB;
use Response;

class DistrictController extends Controller
{
    public function indexAdmin()
    {
        try{
            return View('admin.setdistrict.indexDistrict');
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    } 
    public function loadDistrictAdmin()
    {
        try{
            $districts = District::where('ma_dvhc_cha','ilike','%/82/%')->get();
            return Response::json(['data'=>$districts], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    } 
    public function editDistrictAdmin($id=null)
    {
        if($id)
        {
            try{
                $inforDistricts = District::where('id',$id)->first();
                if($inforDistricts)
                    return View('admin.setdistrict.editDistrict',compact("inforDistricts"));
                return redirect()->route('index.district.admin')->with('errors', 'Lỗi không tìm thấy nativeSRS');
              
            } catch (QueryException $e) {
                return redirect()->route('index.district.admin')->with('errors', 'Lỗi không tìm thấy nativeSRS');
                // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            } catch (Exception $e) {
                // Xử lý các lỗi khác không phải lỗi SQL3 
                return redirect()->route('index.district.admin')->with('errors', 'Lỗi không tìm thấy nativeSRS');
            }   
        }else{
            return redirect()->route('index.district.admin')->with('errors', 'Lỗi không tìm thấy nativeSRS');
        }
    } 
    public function updateDistrict(Request $request,$id=null)  {
        try{
            if($id)
            {
                $request->validate([
                ]);
                $district = District::findOrFail((int)$id);
                $district->update([
                    'tenDVHC'=>(string)$request->tenDVHC,
                    'note'=>(string)$request->note,
                    'valueX'=>(float)$request->valueX,
                    'valueY'=>(float)$request->valueY,
                    'zoomm'=>(float)$request->zoom,
                ]);
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
    // client 
    public function loadDistrictZoom($id=null)  {
        try{
            if($id)
            {
                $district = District::where('id',(int)$id)->first();
                return response()->json(['data' => $district]);
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
