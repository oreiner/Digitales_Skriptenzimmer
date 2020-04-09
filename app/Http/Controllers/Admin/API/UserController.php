<?php

namespace App\Http\Controllers\Admin\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Image;

use Debugbar;

class UserController extends Controller
{

    private $guardName = 'admin_api';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
   // $this->middleware('auth:admin_api');
}



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $this->authorize('isAdmin');
      // if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            //return User::where(['type'=>'user'])->orWhere(['type'=>'moderator'])->latest()->paginate(10);
			//return User::where(['type'=>'user'])->orWhere(['type'=>'moderator'])->orderBy('name','asc')->paginate(10); //order by first name, when format is "first name last name"
      //  }	
	  //if ($unverified) {
		//return User::where(['type'=>'user'])->orWhere(['type'=>'moderator'])->whereNull('email_verified_at')->orderByRaw("CASE WHEN email_verified_at IS NULL THEN 0 ELSE 1 END ASC")->orderByRaw('substring_index(name, \' \', -1)')->paginate(10); //only show unverified users. order by last name, when format is "first name last name"
	  //}else{
	    return User::where(['type'=>'user'])->orWhere(['type'=>'moderator'])->orderByRaw("CASE WHEN banned_at IS NULL THEN 0 ELSE 2 END ASC")->orderByRaw("CASE WHEN manually_verified_at IS NULL THEN 0 ELSE 1 END ASC")->orderByRaw('substring_index(name, \' \', -1)')->paginate(10); //first unverified. order by last name, when format is "first name last name"
	  //}
	  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=> 'required|email|string|max:191"|unique:users',
            'username'=> 'required||min:6|string|max:191"|unique:users',
            'password'=>'required|string|min:6',
            'type'=>'required|string'
        ]);


        return User::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'username'=>$request->username,
                            'password'=>Hash::make($request->password),
                            'bio'=>$request->bio,
                            'photo'=>$request->photo,
                            'type'=>$request->type,
                            'manually_verified_at' => Carbon::now()->toDateTimeString()
                       ]);
    }

   public function updateProfile(Request $request){
       $user=   $user= User::findOrFail($request->id);


      // print_r($user);
      // die;


       $this->validate($request,[
           'name'=>'required|string|max:191',
           'email'=> 'required|email|string|max:191"|unique:users,email,'.$user->id,
           'password'=>'sometimes|required|string|min:6',
       ]);
       $currentPhoto= $user->photo;
       if($request->photo != $currentPhoto){
          $name=time().'.'.explode('/', explode(':', substr($request->photo,0, strpos($request->photo,';')))[1])[1];
          \Image::make($request->photo)->resize(300, 200)->save(public_path('img/profile/').$name);
           $request->merge(['photo' => $name]);

            $userPhoto =  public_path('img/profile/').$currentPhoto;
           if(file_exists($userPhoto)){
              @unlink($userPhoto);
           }

       }

       if(!empty($request->password)){
           $request->merge(['password'=>Hash::make($request['password'])]);
       }


       $user->update($request->all());
   }




    public function profile($id)
    {

        $user= User::findOrFail($id);
        return $user;
       // return auth('admin')->user();

       // return auth('admin-api')->user(); //auth('admin_api')->user();   // auth()->user();
//        Auth::guard('admins')->user();
  // die;
    }

	//manually approve user to use the site for the first time after he registers 
    public function approvedUser($id)
    {
        $user= User::findOrFail($id);
        $user->manually_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
        return $user;
    }
	//manually unapprove user who has been previously approved (mostly in case the moderator falsly clicks on approve)
    public function unapproveUser($id)
    {
        $user= User::findOrFail($id);
        $user->manually_verified_at = null;
        $user->save();
        return $user;
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
	public function ban($id)
    {
        $user= User::findOrFail($id);
            $user->bans()->create([
			    'expired_at' => null
			]);
        //return redirect()->route('users.index')->with('success','Ban Successfully..');
		return $user;
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function revoke($id)
    {
        $user= User::findOrFail($id);
        $user->unban();
        //return redirect()->route('users.index')->with('success','User Revoke Successfully.');
		return $user;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'email'=> 'required|email|string|max:191"|unique:users,email,'.$user->id,
            'username'=> 'required|min:6|string|max:191"|unique:users,username,'.$user->id,
            'password'=>'sometimes|string|min:6',
            'type'=>'required|string'
        ]);
        $user->update($request->all());
        return ['message'=>'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //$this->authorize('isAdmin');
		$user=User::findOrFail($id);
		//close all open feedbacks so reminder email won't crash
		$open_feedbacks = UserToTest::where('user_id',$id)->where('feedback_status',"0")-delete(); 
		//delete user
        $user->delete();
        return ['message'=>'User successfully deleted'];
    }

   public function search(){
        if($search = \Request::get('q')){
           $users =User::where(function ($query) use ($search){
                 $query->where('name', 'LIKE', "%$search%")
                     ->orWhere('email', 'LIKE', "%$search%")
                     ->orWhere('type', 'LIKE', "%$search%");
           })->paginate(20);
        }else{
            $users= User::latest()->paginate(20);
          }
        return $users;
   }



}
