<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\{Log,Children,Family_book,Wive};

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function AddToLog($title,$operating_code,$operating_name)
    {
        $addlog = new Log();
        $addlog -> title = $title;
        $addlog -> operating_name = $operating_name;
        $addlog -> operating_code = $operating_code;
        $addlog -> user_id = Auth::user()->id;
        $addlog -> save();
    }


    public function index(Request $Request)
    {
        $this->UpdateChildren();
        $this->UpdateAge();
        $this->UpdateWives();
        $this->UpdateHusband();

        if (Auth::user()->role_id == 1) {
            return view('admin/Home');
        } else {

            return view('user/Home');
        }
    }

    public function UpdateChildren()
    {
        $DateNow = Carbon::parse(Carbon::now());
        $Children = Children::all();
        foreach ($Children as $key => $child) {
            $updateChildren = Children::find($child->id);
            $birthDate = Carbon::parse($child->birth_date);
            $age = $DateNow->year - $birthDate->year;
            $updateChildren -> age_years = $age;
            $updateChildren -> age_month = (($age - 1) * 12) + (12 - $birthDate->month) + $DateNow->month;
            $updateChildren -> save();
        }
    }

    public function UpdateAge()
    {
        $DateNow = Carbon::parse(Carbon::now());
        $Family_books = Family_book::all();
        foreach ($Family_books as $key => $Family_book) {
            $updateAge = Family_book::find($Family_book->id);
            $birthDate = Carbon::parse($Family_book->birth_date);
            $age = $DateNow->year - $birthDate->year;
            $updateAge -> age_years = $age;
            $updateAge -> save();
        }
    }

    public function UpdateWives()
    {
        $DateNow = Carbon::parse(Carbon::now());
        $Wives = Wive::all();
        foreach ($Wives as $key => $Wife) {
            $updateWife = Wive::find($Wife->id);
            $birthDate = Carbon::parse($Wife->birth_date);
            $age = $DateNow->year - $birthDate->year;
            $updateWife -> age_years = $age;
            $updateWife -> save();
        }
    }

    public function UpdateHusband()
    {
        $DateNow = Carbon::parse(Carbon::now());
        $Family_books = Family_book::all();
        foreach ($Family_books as $key => $Family_book) {
            $updateAge = Family_book::find($Family_book->id);
            $birthDate = Carbon::parse($Family_book->birth_date_husband);
            $age = $DateNow->year - $birthDate->year;
            $updateAge -> age_years_husband = $age;
            $updateAge -> save();
        }
    }
}
