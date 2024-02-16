<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use App\Models\{Addresse,Children_statu,Marital_statu,Residence_statu,Family_book,Wive,Children,Measuring_unit,Receiving_aid,Receiving_aid_detail,Receiving_scholarship,Receiving_scholarship_detail};


class FormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function ViewScholarships(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Receiving_scholarships = Receiving_scholarship::select('id', 'date', 'number')->groupBy('date')->get();
                $Family_books = Family_book::where('status_from_organization','مقبول')->get();
                $arr = array('Family_books' => $Family_books, 'Receiving_scholarships' => $Receiving_scholarships); 
                return view('admin/management_forms/ViewScholarships',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function CreateScholarships(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {
                if ($Request->isMethod('get')) {   
                    $Measuring_units = Measuring_unit::all();
                    $arr = array('Measuring_units' => $Measuring_units);
                    return view('admin/management_forms/CreateScholarships',$arr);
                }else {

                    $Family_books = Family_book::where('status_from_organization','مقبول')->get();
                    foreach ($Family_books as $key => $Family_book) {
                        $newReceiving_scholarship = new Receiving_scholarship();
                        $newReceiving_scholarship -> date = $Request->input('date');
                        $date = Carbon::parse($Request->input('date'));
                        if ($Family_book->receiving_scholarships->count() == Null) {
                            $newReceiving_scholarship -> serial_number = 'C-'.$Family_book->id.'-'.$date->month.'-'. 1;
                            $newReceiving_scholarship -> number = 1;
                        } else{
                            $number = $Family_book->receiving_scholarships->count() + 1;
                            $newReceiving_scholarship -> serial_number = 'C-'.$Family_book->id.'-'.$date->month.'-'.$number ;
                            $newReceiving_scholarship -> number = $number;
                        }
                        $newReceiving_scholarship -> employee_name = $Request->input('employee_name');
                        $newReceiving_scholarship -> family_books_id = $Family_book->id;
                        $newReceiving_scholarship -> save();

                        for ($i=0; $i < $Request->input('count_item') ; $i++) {

                            $newItem = new Receiving_scholarship_detail();
                            $newItem -> item = $Request->items[$i]['item'];
                            $newItem -> measuring_unit_id = $Request->items[$i]['measuring_unit_id'];
                            $newItem -> quantity = $Request->items[$i]['quantity'];
                            $newItem -> receiving_scholarship_id = $newReceiving_scholarship->id;
                            $newItem -> save();
                        }
                    }
                    return redirect('/Scholarships'); 
                }
            }

        else{return view('public/404');} 
        
    }

    public function EditScholarships(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {
                if ($Request->isMethod('get')) {   
                    $Receiving_scholarship = Receiving_scholarship::where('date',$Request->date)->where('number',$Request->number)->first();
                    $Measuring_units = Measuring_unit::all();
                    $arr = array('Receiving_scholarship' => $Receiving_scholarship, 'Measuring_units' => $Measuring_units);
                    return view('admin/management_forms/EditScholarships',$arr);
                }else {

                    $Receiving_scholarships = Receiving_scholarship::where('date',$Request->date)->where('number',$Request->number)->get();
                    foreach ($Receiving_scholarships as $key => $EditReceiving_scholarship) {
                        $EditReceiving_scholarship -> date = $Request->input('date');
                        $date = Carbon::parse($Request->input('date'));
                        $EditReceiving_scholarship -> employee_name = $Request->input('employee_name');
                        $EditReceiving_scholarship -> save();

                        $DeleteItems = Receiving_scholarship_detail::where('receiving_scholarship_id',$EditReceiving_scholarship->id);
                        $DeleteItems -> delete();
                        for ($i=0; $i < $Request->input('count_item') ; $i++) {

                            $newItem = new Receiving_scholarship_detail();
                            $newItem -> item = $Request->items[$i]['item'];
                            $newItem -> measuring_unit_id = $Request->items[$i]['measuring_unit_id'];
                            $newItem -> quantity = $Request->items[$i]['quantity'];
                            $newItem -> receiving_scholarship_id = $EditReceiving_scholarship->id;
                            $newItem -> save();
                        }
                    }
                    return redirect('/EditScholarshipsAid'); 
                }
            }

        else{return view('public/404');} 
        
    }

    public function ViewAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Receiving_aids = Receiving_aid::select('id', 'date', 'number')->groupBy('date')->get();
                $Family_books = Family_book::where('status_from_organization','مقبول')->get();
                $arr = array('Family_books' => $Family_books, 'Receiving_aids' => $Receiving_aids); 
                return view('admin/management_forms/ViewAid',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function CreateAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                if ($Request->isMethod('get')) {
                    $Measuring_units = Measuring_unit::all();
                    $arr = array('Measuring_units' => $Measuring_units);
                    return view('admin/management_forms/CreateAid',$arr);
                }else{

                    $Family_books = Family_book::where('status_from_organization','مقبول')->get();
                    foreach ($Family_books as $key => $Family_book) {
                        $newReceiving_aid = new Receiving_aid();
                        $newReceiving_aid -> date = $Request->input('date');
                        $date = Carbon::parse($Request->input('date'));
                        if ($Family_book->receiving_aids->count() == Null) {
                            $newReceiving_aid -> serial_number = 'C-'.$Family_book->id.'-'.$date->month.'-'. 1;
                            $newReceiving_aid -> number = 1;
                        } else{
                            $number = $Family_book->receiving_aids->count() + 1;
                            $newReceiving_aid -> serial_number = 'C-'.$Family_book->id.'-'.$date->month.'-'.$number ;
                            $newReceiving_aid -> number = $number;
                        }
                        
                        $newReceiving_aid -> employee_name = $Request->input('employee_name');
                        $newReceiving_aid -> family_books_id = $Family_book->id;
                        $newReceiving_aid -> save();

                        for ($i=0; $i < $Request->input('count_item') ; $i++) {

                            $newItem = new Receiving_aid_detail();
                            $newItem -> item = $Request->items[$i]['item'];
                            $newItem -> measuring_unit_id = $Request->items[$i]['measuring_unit_id'];
                            $newItem -> quantity = $Request->items[$i]['quantity'];
                            $newItem -> receiving_aid_id = $newReceiving_aid->id;
                            $newItem -> save();
                        }
                    }
                    return redirect('/Aid');
                }
            }

        else{return view('public/404');} 
        
    }

    public function EditAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                if ($Request->isMethod('get')) {
                    $Receiving_aid = Receiving_aid::where('date',$Request->date)->where('number',$Request->number)->first();
                    $Measuring_units = Measuring_unit::all();
                    $arr = array('Receiving_aid' => $Receiving_aid, 'Measuring_units' => $Measuring_units);
                    return view('admin/management_forms/EditAid',$arr);
                }else{

                    $Receiving_aids = Receiving_aid::where('date',$Request->date)->where('number',$Request->number)->get();
                    foreach ($Receiving_aids as $key => $EditReceiving_aid) {
                        $EditReceiving_aid -> date = $Request->input('date');
                        $EditReceiving_aid -> employee_name = $Request->input('employee_name');
                        $EditReceiving_aid -> save();

                        $DeleteItems = Receiving_aid_detail::where('receiving_aid_id',$EditReceiving_aid->id);
                        $DeleteItems -> delete();
                        for ($i=0; $i < $Request->input('count_item') ; $i++) {

                            $newItem = new Receiving_aid_detail();
                            $newItem -> item = $Request->items[$i]['item'];
                            $newItem -> measuring_unit_id = $Request->items[$i]['measuring_unit_id'];
                            $newItem -> quantity = $Request->items[$i]['quantity'];
                            $newItem -> receiving_aid_id = $EditReceiving_aid->id;
                            $newItem -> save();
                        }
                    }
                    return redirect('/EditScholarshipsAid'); 
                }
            }

        else{return view('public/404');} 
        
    }

    public function EditScholarshipsAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Receiving_scholarships = Receiving_scholarship::select('id', 'date', 'number')->groupBy('date')->get();
                $Receiving_aids = Receiving_aid::select('id', 'date', 'number')->groupBy('date')->get();
                $arr = array('Receiving_scholarships' => $Receiving_scholarships, 'Receiving_aids' => $Receiving_aids);
                return view('admin/management_forms/EditScholarshipsAid',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function ViewEditFamilyBooks(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Family_books = Family_book::all();
                $arr = array('Family_books' => $Family_books);
                return view('admin/management_forms/ViewEditFamilyBooks',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function DeleteFamilyBook(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $DeleteFamily_book = Family_book::find($Request->id_FB);
                $DeleteFamily_book -> delete();

                $Family_book = 'Family_book';
                return response()->json($Family_book); 
            }

        else{return view('public/404');} 

    }

    public function EditStatusFamilyBooks(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Family_books = Family_book::all();
                $arr = array('Family_books' => $Family_books);
                return view('admin/management_forms/EditStatusFamilyBooks',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function AcceptFamilyBook(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $StatusFamily_book = Family_book::find($Request->id_FB);
                $StatusFamily_book -> status_from_organization = 'مقبول';
                $StatusFamily_book -> save();

                $this->AddToLog('  تغيير حالة الدفتر إلى مقبول  ',$StatusFamily_book->first_name.' '.$StatusFamily_book->last_name , $StatusFamily_book->id);

                $Family_book = Family_book::all();
                return response()->json($Family_book); 
            }

        else{return view('public/404');} 

    }

    public function PauseFamilyBook(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $StatusFamily_book = Family_book::find($Request->id_FB);
                $StatusFamily_book -> status_from_organization = 'ايقاف';
                $StatusFamily_book -> save();

                $this->AddToLog('  تغيير حالة الدفتر إلى ايقاف  ',$StatusFamily_book->first_name.' '.$StatusFamily_book->last_name , $StatusFamily_book->id);

                $Family_book = Family_book::all();
                return response()->json($Family_book);
            }

        else{return view('public/404');} 

    }

    public function RejectFamilyBook(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $StatusFamily_book = Family_book::find($Request->id_FB);
                $StatusFamily_book -> status_from_organization = 'مرفوض';
                $StatusFamily_book -> save();

                $this->AddToLog('  تغيير حالة الدفتر إلى مرفوض  ',$StatusFamily_book->first_name.' '.$StatusFamily_book->last_name , $StatusFamily_book->id);

                $Family_book = Family_book::all();
                return response()->json($Family_book); 
            }

        else{return view('public/404');} 

    }

    public function NotesFamilyBooks(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $NotesFamily_book = Family_book::find($Request->idFB);
                $NotesFamily_book -> status_from_organization_notes = $Request->input('status_from_organization_notes');
                $NotesFamily_book -> save();
                return redirect('/EditStatusFamilyBooks');
            }

        else{return view('public/404');} 

    }

    public function EditFamilyBooks(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                if ($Request->isMethod('get')) {
                    $Family_books = Family_book::find($Request->idFB); 
                    $Addresses = Addresse::all();
                    $Children_status = Children_statu::all();
                    $Marital_status = Marital_statu::all();
                    $Residence_status = Residence_statu::all();
                    $arr = array('Family_books' => $Family_books, 'Addresses' => $Addresses, 'Children_status' => $Children_status, 'Marital_status' => $Marital_status, 'Residence_status' => $Residence_status);
                    return view('admin/management_forms/EditFamilyBooks',$arr);
                }else {

                    $DateNow = Carbon::parse(Carbon::now());

                    $editFamilyBook = Family_book::find($Request->idFB);
                    $editFamilyBook -> id2 = $Request->input('id2');
                    $editFamilyBook -> first_name = $Request->input('first_name');
                    $editFamilyBook -> last_name = $Request->input('last_name');
                    $editFamilyBook -> father_nqme = $Request->input('father_nqme');
                    $editFamilyBook -> national_id = $Request->input('national_id');
                    $editFamilyBook -> book_id = $Request->input('book_id');
                    $editFamilyBook -> birth_date = $Request->input('birth_date');
                    $editFamilyBook -> gender_participant = $Request->input('gender_participant');
                    $editFamilyBook -> husband_name = $Request->input('husband_name');
                    $editFamilyBook -> birth_date_husband = $Request->input('birth_date_husband');
                    $editFamilyBook -> marital_status_id = $Request->input('marital_status_id');
                    $editFamilyBook -> residence_status_id = $Request->input('residence_status_id');
                    $editFamilyBook -> notes = $Request->input('notes');
                    $editFamilyBook -> address_id = $Request->input('address_id');
                    $editFamilyBook -> address_details = $Request->input('address_details');
                    $editFamilyBook -> mobile = $Request->input('mobile');
                    $editFamilyBook -> phone = $Request->input('phone');
                    $editFamilyBook -> save();

                    $DeleteWife = Wive::where('family_book_id',$Request->idFB);
                    $DeleteWife -> delete();
                    for ($i=0; $i < $Request->input('count_wife') ; $i++) {

                        $newWife = new Wive();
                        $newWife -> name = $Request->wives[$i]['wife_name'];
                        $newWife -> birth_date = $Request->wives[$i]['wife_birth_date'];
                        $newWife -> family_book_id = $Request->idFB;
                        $newWife -> save();

                    }

                    $DeleteChildren = Children::where('family_book_id',$Request->idFB);
                    $DeleteChildren -> delete();
                    for ($i=0; $i < $Request->input('count_childe') ; $i++) {

                        $newChildren = new Children();
                        $newChildren -> name = $Request->children[$i]['childe_name'];
                        $newChildren -> birth_date = $Request->children[$i]['childe_birth_date'];
                        $newChildren -> gender = $Request->children[$i]['gender'];
                        $birthDate = Carbon::parse($Request->children[$i]['childe_birth_date']);
                        $age = $DateNow->year - $birthDate->year;
                        $newChildren -> age_years = $age;
                        $newChildren -> age_month = (($age - 1) * 12) + (12 - $birthDate->month) + $DateNow->month;
                        $newChildren -> status_id = $Request->children[$i]['childe_status_id'];
                        $newChildren -> status_notes = $Request->children[$i]['status_notes'];
                        $newChildren -> family_book_id = $Request->idFB;
                        $newChildren -> save();

                    }

                    $this->AddToLog('تعديل دفتر عائلة جديد ',$editFamilyBook->first_name.' '.$editFamilyBook->last_name , $editFamilyBook->id);
                    return redirect('/ViewEditFamilyBooks');
                    
                }
            }

        else{return view('public/404');} 
        
    }

}