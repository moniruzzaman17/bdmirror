<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    protected function guard(){
        if (request('user_type') == "ctz") {
            return Auth::guard('citizen');
        }
        else{
            return Auth::guard('authority');
        }
    }
    // /**
    //  * Redirect to homepage after login.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function redirectTo(){
        if (request('user_type') == "ctz") {
            return route('home'); // works for login
        } else {
            return route('home'); // works for login
        }
        
    }

    // /**
    //  * Get the login username to be used by the controller.
    //  *
    //  * @return string
    //  */
    public function username()
    {
        return 'mobile';
    }

    // /**
    //  * Validate the user login request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return void
    //  *
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|regex:/(01)[0-9]{9}/',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return [
            'mobile'=>$request->{$this->username()},
            'password'=>$request->password
        ];
    }
    public function authenticated(Request $request, $user) {
        $user->touch();
    }
    public function logout(Request $request){
        if (Auth::guard('citizen')->check()) {
            $this->guard('citizen')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect()->route('home');
        } else if (Auth::guard('authority')->check()) {
            $this->guard('authority')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        else{
            return false;
        }
    }
}
