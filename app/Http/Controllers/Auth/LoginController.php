<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserLogined;
use Auth;
use Illuminate\Http\Request;
use Socialite;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }


    public function username()
    {
        return 'email';
    }

    public function redirectTo()
    {
        $auth_user = Auth::user();
        activity('User')->performedOn($auth_user)
            ->causedBy($auth_user)
            ->log('User Logined');
        $user_logined = new UserLogined();
        $auth_user->notify($user_logined);

        return route('admin.dashboard.index');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($social_company)
    {
        $social_companies = ['google', 'github', 'gitlab', 'linkedin', 'twitter', 'facebook', 'bitbucket'];

        if(array_search($social_company, $social_companies, true) !== false){
            return Socialite::driver($social_company)->redirect();
        }

        return abort(404);
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('google')->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();

        if($user){
            Auth::login($user);
            activity('User Login')
                ->performedOn($user)
                ->causedBy(Auth::user())
                ->log('User Login');

            return redirect()->route('admin.dashboard.index');
        }

        return view('auth.register', ['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
    }
}
