<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Response;
use DB;

class ContactController extends Controller
{
    //admin
    public function index()  {
        return View('admin.setcontact.indexContact');
    }
    public function loadContact() {
        try{
            $contacts=Contact::all();
            return Response::json(['data'=>$contacts], 200);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function infoContact($id=null)  {
        try{
            if ($id) {
                $inforContacts=Contact::where('id', '=', $id)->first();
                if($inforContacts==null)
                {
                    return redirect()->route('index.contact')->with('errors', 'Lỗi không tìm thấy danh mục');
                }
                else{
                    $inforContact=$inforContacts;
                    $inforContacts->update(['active'=>true]);
                    return view('admin.setcontact.inforContact',compact('inforContact'));
                }
            }else {
                return redirect()->route('index.contact')->with('errors', 'Lỗi không tìm thấy danh mục');
            }
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function destroyContact($id) {
        try{
            $contact=Contact::where('id', (int)$id)
            ->update([
                'is_delete'=>true,
            ]);
            return response()->json(['success' => $contact]);
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    //client
    public function createContact() {
        try{
            return view('clients.contact.indexContact');
        } catch (QueryException $e) {
            // Xử lý lỗi khi có lỗi SQL, ví dụ: Constraint violation, duplicate entry, etc.
            return response()->json(['error' => 'Database error: '.$e->getMessage()]);
        } catch (Exception $e) {
            // Xử lý các lỗi khác không phải lỗi SQL3 
            return response()->json(['error' => 'Error: '.$e->getMessage()]);
        }
    }
    public function saveContact(Request $request) {
        try{
            $request->validate([
                'name' => ['nullable',  'regex:/^[a-zA-Z0-9\s\p{L}.,\-\/@&()#]+$/u'],
            ]);
            $contact = new Contact();
            $contact->name = (string)$request->name;
            $contact->title = $request->title;
            $contact->district = (string)$request->district;
            $contact->describe = (string)$request->describe;
            $contact->email = (string)$request->email;

            $contact->save();
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
