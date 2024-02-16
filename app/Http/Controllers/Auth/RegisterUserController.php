<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $Request)
    {

        $perm = Auth::user()->role->permissions->where('title','ManagementUsers');
        if ($perm != '[]') 
        {
            return view('auth/register');
        }
        else
        {
            return view('public/404');
        } 

    }


    public function create(Request $Request)
    {
		Validator::make($Request->all(), [
		'name' => 'required|alpha|max:25|min:2|unique:users',
		'password' => 'required|string|min:8',
        'email' => 'required|string|email|unique:users|max:50',
    	])->validate();

    	$arr = User::create([
        'name' => $Request['name'],
        'email' => $Request['email'],
		'password' => Hash::make($Request['password']),
        'mobile' => $Request['mobile'],
    	]);

        return redirect('/'); 
			
	}
    	
}
