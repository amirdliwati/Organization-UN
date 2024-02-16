<?php

namespace App\Http\Controllers\user;

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
use App\Models\{Family_book,Visit};


class VisitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Visits(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','EntryForms');
        if ($perm != '[]') 
            {   
                $Visits = Visit::where('user_id',Auth::user()->id)->get();
                $arr = array('Visits' => $Visits); 
                return view('user/Visits',$arr);
            }

        else{return view('public/404');} 
        
    }

    public function CreateVisit(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','EntryForms');
        if ($perm != '[]') 
            {
                if ($Request->isMethod('get')) {   
                    $Family_books = Family_book::where('user_id',Auth::user()->id)->get();
                    $arr = array('Family_books' => $Family_books);
                    return view('user/CreateVisits',$arr);
                }else {

                        $newVisit = new Visit();
                        $newVisit -> date = $Request->input('date');
                        $newVisit -> name = $Request->input('name');
                        $newVisit -> fodder = $Request->input('fodder');
                        $newVisit -> chicken = $Request->input('chicken');
                        $newVisit -> status = $Request->input('helth_status');
                        $newVisit -> breeding = $Request->input('breeding');
                        $newVisit -> eggs = $Request->input('eggs');
                        $newVisit -> household = $Request->input('household');
                        $newVisit -> selling = $Request->input('selling');
                        $newVisit -> selling_price = $Request->input('selling_price');
                        $newVisit -> advise = $Request->input('advise');
                        $newVisit -> notes = $Request->input('notes');
                        $newVisit -> family_books_id = $Request->input('family_books_id');
                        $newVisit -> user_id = Auth::user()->id;
                        $newVisit -> save();
                        return redirect('/Visits');

                        $this->AddToLog('اضافة زيارة ',$newVisit->date , $newVisit->id); 
                    }   
            }

        else{return view('public/404');} 
        
    }
}