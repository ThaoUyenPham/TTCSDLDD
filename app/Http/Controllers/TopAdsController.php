<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopAds;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Response;
use DB;
use Auth;

class TopAdsController extends Controller
{
    public function index()  {
        return View('admin.settopads.indexTopAds');
    }
    public function editTopAds($id)  {
        try{
            if (is_numeric($id) || $id > 0) {
                $inforTopAds=TopAds::where('id', '=', $id)->where(function($query) {
                    $query->whereNull('is_delete')
                        ->orWhere('is_delete', false);
                })
                ->first();
                if($inforTopAds==null)
                    return redirect()->route('index.topads')->with('errors', 'Lỗi không tìm thấy danh mục');
                    return view('admin.settopads.editTopAds',compact('inforTopAds'));
            }else {
                return redirect()->route('index.topads')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function saveTopAds(Request $request)  {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'number' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $topAds = new TopAds();
            $topAds->name = (string)$request->name;
            $topAds->is_block = $request->is_block;
            $topAds->number_oder = (int)$request->number;
            $topAds->describe = (string)$request->describe;
            $topAds->save();
            return response()->json(['success' => '1']);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroyTopAds($id)  {
        try{
            // danh muc con
            $topAds=TopAds::where('id', (int)$id)
            ->update([
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
    }
    public function loadTopAds()  {
        try{
            $topAds=TopAds::where(function($query) {
                $query->whereNull('is_delete')
                    ->orWhere('is_delete', false);
            })->get();
            return Response::json(['data'=>$topAds], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function createTopAds()  {
        return view('admin.settopads.createTopAds');
    }
    public function updateTopAds(Request $request,$id)  {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
                'is_block' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'number_oder' => ['nullable', 'regex:/^[a-zA-Z0-9\s]+$/'],
            ]);
            $topAds = TopAds::findOrFail((int)$id);
            $topAds->update([
                'name'=>(string)$request->name,
                'is_block'=>$request->is_block,
                'number_oder'=>(int)$request->number_oder,
                'describe'=>$request->describe,
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
}
