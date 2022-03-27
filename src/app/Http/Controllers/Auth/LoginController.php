<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;
use App\User;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle(){
        return socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback($provider){
       
        try {
            $user = socialite::driver('google')->user();
        }catch(Exception $e) {
            return redirect('/login')->with('予期せぬエラーが発生しました。');
        }

        if($login_user = User::where('email', $user->getEmail())->first()){
            dd($login_user);
            if($login_user->provider_name !== null && $login_user->provider_id !== null) {
            
                Auth::Login($login_user, true);
                return redirect('/home');
            
            } else {
                
                $login_user->provider_name = $provider;
                $login_user->provider_id = $user->getId();
                $login_user->save();
                
                Auth::Login($login_user, true);
                return redirect('/home');
            
            }

        } else {
                
                $login_user = new User();
                $login_user->name = 'sample';
                $login_user->email = $user->getEmail();
                $login_user->provider_name = $provider;
                $login_user->provider_id = $user->getId();
                $login_user->save();
                Auth::Login($login_user, true);
                return redirect('/home');
        }
            
    }
}
