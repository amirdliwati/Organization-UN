<?php

namespace App\Http\Controllers\mutual;

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
use App\Models\{Addresse,Children_statu,Marital_statu,Residence_statu,Family_book,Wive,Children};


class FormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ViewFamilyBooks(Request $Request)
    {   
		$perm = Auth::user()->role->permissions->where('title','EntryForms');
        if ($perm != '[]') 
            {
                if (Auth::user()->role->id == 1 ) {
                        $Family_books = Family_book::where('status_from_organization','مقبول')->get();
                        $arr = array('Family_books' => $Family_books);
                   }else {   
                        $Family_books = Family_book::where('user_id','=',Auth::user()->id)->where('status_from_organization','مقبول')->get();
                        $arr = array('Family_books' => $Family_books);
                    }
                return view('mutual/ViewFamilyBooks',$arr);
            }

        else{return view('public/404');} 
    	
    }

    public function CreateFamilyBooks(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','EntryForms');
        if ($perm != '[]') 
            {   
                if ($Request->isMethod('get')) { 
                    $Addresses = Addresse::all();
                    $Children_status = Children_statu::all();
                    $Marital_status = Marital_statu::all();
                    $Residence_status = Residence_statu::all();
                    $arr = array('Addresses' => $Addresses, 'Children_status' => $Children_status, 'Marital_status' => $Marital_status, 'Residence_status' => $Residence_status);
                    return view('mutual/CreateFamilyBooks',$arr);
                }else {

                    $DateNow = Carbon::parse(Carbon::now());

                    $newFamilyBook = new Family_book();
                    $newFamilyBook -> id2 = $Request->input('id2');
                    $newFamilyBook -> first_name = $Request->input('first_name');
                    $newFamilyBook -> last_name = $Request->input('last_name');
                    $newFamilyBook -> father_nqme = $Request->input('father_nqme');
                    $newFamilyBook -> national_id = $Request->input('national_id');
                    $newFamilyBook -> book_id = $Request->input('book_id');
                    $newFamilyBook -> birth_date = $Request->input('birth_date');
                    $newFamilyBook -> gender_participant = $Request->input('gender_participant');
                    $newFamilyBook -> husband_name = $Request->input('husband_name');
                    $newFamilyBook -> birth_date_husband = $Request->input('birth_date_husband');
                    $newFamilyBook -> marital_status_id = $Request->input('marital_status_id');
                    $newFamilyBook -> residence_status_id = $Request->input('residence_status_id');
                    $newFamilyBook -> notes = $Request->input('notes');
                    $newFamilyBook -> address_id = $Request->input('address_id');
                    $newFamilyBook -> address_details = $Request->input('address_details');
                    $newFamilyBook -> mobile = $Request->input('mobile');
                    $newFamilyBook -> phone = $Request->input('phone');
                    $newFamilyBook -> user_id = Auth::user()->id;
                    $newFamilyBook -> save();

                    for ($i=0; $i < $Request->input('count_wife') ; $i++) {

                        $newWife = new Wive();
                        $newWife -> name = $Request->wives[$i]['wife_name'];
                        $newWife -> birth_date = $Request->wives[$i]['wife_birth_date'];
                        $newWife -> family_book_id = $newFamilyBook->id;
                        $newWife -> save();

                    }

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
                        $newChildren -> family_book_id = $newFamilyBook->id;
                        $newChildren -> save();

                    }

                    $this->AddToLog('اضافة دفتر عائلة جديد ',$newFamilyBook->first_name.' '.$newFamilyBook->last_name , $newFamilyBook->id);
                    return redirect('/FamilyBooks');
                    
                }
            }

        else{return view('public/404');} 
        
    }

}
