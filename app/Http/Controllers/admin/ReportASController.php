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
use PDF;
use DB;
use App\User;
use App\Models\{Family_book,Receiving_aid,Receiving_scholarship,Receiving_aid_detail,Receiving_scholarship_detail};

class ReportASController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function FamilyBooksAS(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Family_books = Family_book::all();
                $arr = array('Family_books' => $Family_books);
                return view('admin/reports/FamilyBooksAS',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function ViewAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Aids = Receiving_aid::where('family_books_id',$Request->idFB)->get();
                $arr = array('Aids' => $Aids);
                return view('admin/reports/ViewAids',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function ViewScholarship(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Scholarships = Receiving_scholarship::where('family_books_id',$Request->idFB)->get();
                $arr = array('Scholarships' => $Scholarships);
                return view('admin/reports/ViewScholarships',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function DeleteScholarship(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $DeleteScholarship = Receiving_scholarship::where('serial_number',$Request->id)->first();
                $DeleteScholarship -> delete();

                $Scholarship = 'Scholarship';
                return response()->json($Scholarship); 
            }

        else{return view('public/404');} 

    }

    public function DeleteAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $DeleteAid = Receiving_aid::where('serial_number',$Request->id)->first();
                $DeleteAid -> delete();

                $Aid = 'Aid';
                return response()->json($Aid); 
            }

        else{return view('public/404');} 

    }

    public function ViewScholarshipAid(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            {   
                $Receiving_scholarships = Receiving_scholarship::select('id', 'date', 'number')->groupBy('date')->get();
                $Receiving_aids = Receiving_aid::select('id', 'date', 'number')->groupBy('date')->get();
                $arr = array('Receiving_scholarships' => $Receiving_scholarships, 'Receiving_aids' => $Receiving_aids);
                return view('admin/reports/ScholarshipAid',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function DetailsScholarships(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            { 
                $Receiving_scholarship = Receiving_scholarship::where('date',$Request->date)->where('number',$Request->number)->first();
                $Details = Receiving_scholarship_detail::where('receiving_scholarship_id',$Receiving_scholarship->id)->get();
                $arr = array('Details' => $Details);
                return view('admin/reports/DetailsAS',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function DetailsAids(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Receiving_aid = Receiving_aid::where('date',$Request->date)->where('number',$Request->number)->first();
                $Details = Receiving_aid_detail::where('receiving_aid_id',$Receiving_aid->id)->get();
                $arr = array('Details' => $Details);
                return view('admin/reports/DetailsAS',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function RScholarships(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Reports');
        if ($perm != '[]') 
            { 
                $Details = Receiving_scholarship::where('date',$Request->date)->where('number',$Request->number)->get();
                $arr = array('Details' => $Details);
                return view('admin/reports/RAS',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function RAids(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','Forms');
        if ($perm != '[]') 
            {   
                $Details = Receiving_aid::where('date',$Request->date)->where('number',$Request->number)->get();
                $arr = array('Details' => $Details);
                return view('admin/reports/RAS',$arr);
            }

        else{return view('public/404');} 
        
    }

}