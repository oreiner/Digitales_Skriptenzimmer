<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        $user=User::find(auth()->user()->id);
        return view('profile',compact('user'));
    }

    public function updateProfile(Request $request){
      // print_r($request->all());
       // die;
          $user= User::findOrFail(auth()->user()->id);
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=> 'required|email|string|max:191"|unique:users,email,'.$user->id,
            'username'=> 'required|string|min:6"|unique:users,username,'.$user->id,
            'password'=> 'nullable|string|min:6',
        ]);

        if(!empty($request->password)){
            $request->merge(['password'=>bcrypt($request['password'])]);
        }else{
            unset($request['password']);
        }
        $user->update($request->all());
        Session::flash('success', ' Dein Profil wurde erfolgreich aktualisiert');

        return redirect('/');
    }
	
}
