<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    //private $guardName = 'admin_api';

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');
       // $data['type'] = 'admin';
        return $data;
    }





    use AuthenticatesUsers;


//    public function username()
//    {
//        return 'username';
//    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * LoginController constructor.
     */
    public function __construct(){

    }

    /**
     * function to show Login Formt
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(){
        if (Auth::guard('admins')->check()) {
            return redirect('/admin');
        }
        //die;
        return view('admin.auth.login');
    }


    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {
        $identity  = request()->get('email');
        $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldName => $identity]);
        return $fieldName;
    }


    /**
     * Validate the user login.
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|min:6|string',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Username or email is required',
                'email.min' => 'Username or email must be at least 6 characters',
                'password.required' => 'Password is required',
            ]
        );
    }






    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */


    protected function authenticated(Request $request, $user)
    {
        if ($user->type == 'user') { // or whatever status column name and value indicates a blocked user

            $message = 'These credentials do not match our records.';

            // Log the user out.
            $this->logout($request);

            // Return them to the log in form.
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    // This is where we are providing the error message.
                    $this->username() => $message,
                ]);
        }
    }





    protected function guard(){
        return Auth::guard('admins');
    }
    protected $redirectTo = '/admin';


    /**
     * Log the user out of the application.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->put('login_error', trans('auth.failed'));
        throw ValidationException::withMessages(
            [
                'error' => [trans('auth.failed')],
            ]
        );
    }





    public function logout(Request $request){
        $this->guard('admins')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/admin/login');
    }
}