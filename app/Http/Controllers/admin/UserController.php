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
use App\User;
use App\Models\{Log};


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function View(Request $Request)
    {
		$perm = Auth::user()->role->permissions->where('title','ManagementUsers');
        if ($perm != '[]') 
            {   
                $users = User::where('id','>',1)->orderBy('id', 'desc')->get();
                $arr = array('users' => $users);
                return view('admin/users_profiles/ViewUsers',$arr);
            }

        else{return view('public/404');} 
    	
    }

    public function StatusUser(Request $Request)
    {
        $perm = Auth::user()->role->permissions->where('title','ManagementUsers');
        if ($perm != '[]')
            {
                $StatusUser = User::find($Request->id_user);

                if ($StatusUser->status == 1) {
                    $StatusUser -> status = 0;
                    $StatusUser -> password = Hash::make('asdhhhhfkdhfhjkdfyyyhdfjhkhdfhdjfhdkhfjdfhk');
                    $StatusUser -> save(); 
                } else{
                    $StatusUser -> status = 1;
                    $StatusUser -> password = Hash::make($StatusUser->email);
                    $StatusUser -> save();  
                }

                $Users = User::all();
                return response()->json($Users);     
            }

        else{return view('public/404');} 

        
    }

    public function Edit(Request $Request)
    {
        if ($Request->isMethod('post')) {
            $perm = Auth::user()->role->permissions->where('title','ManagementUsers');
            if ($perm != '[]')
                {
                    Validator::make($Request->all(), [
                    'name' => 'required|alpha|max:25|min:2',
                    ])->validate();

                    $EditUser = User::find($Request->idUser);
                    $EditUser -> name = $Request->input('name');
                    $EditUser -> password = Hash::make($Request->input('password'));
                    $EditUser -> mobile = $Request->input('mobile');
                    $EditUser -> save(); 

                    return redirect('/ViewUsers');     
                }

            else{return view('public/404');}
        } else {
            $perm = Auth::user()->role->permissions->where('title','ManagementUsers');
            if ($perm != '[]')
                {
                    $User = User::find($Request->idUser);
                    $arr = array('User' => $User);
                    return view('admin/users_profiles/ViewUser',$arr);     
                }

            else{return view('public/404');}
        }

        
    }

    public function ViewLogs(Request $Request)
    {
		$perm = Auth::user()->role->permissions->where('title','ManagementUsers');
        if ($perm != '[]')
            {    
                $logs = Log::all();
                $arr = array('logs' => $logs);
                return view('admin/users_profiles/LogUser',$arr);
            }

        else{return view('public/404');} 
    }


}
