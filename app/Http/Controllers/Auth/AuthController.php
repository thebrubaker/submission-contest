<?php

namespace App\Http\Controllers\Auth;

use Validator;

use App\Http\Controllers\Controller;
use App\User;
use App\Profile;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Facebook\Facebook;
use Facebook\Authentication\AccessToken;
use App\Services\FacebookService;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Redirect after user has been created and logged in
     * @var string
     */
    protected $redirectTo = '/submissions';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create($data);
    }

    /**
     * Get the welcome page
     * @return Illuminate\View\View
     */
    protected function getWelcome()
    {
        return view('welcome');
    }

    // protected function getFacebookLogin()
    // {
    //     $fb = new Facebook([
    //         'app_id' => '949704785045810',
    //         'app_secret' => '234413690aff34d4dc37d1cab12c646b',
    //         'default_graph_version' => 'v2.4',
    //     ]);
    //     $helper = $fb->getRedirectLoginHelper();
    //     $permissions = ['email,user_friends,user_hometown,user_location'];
    //     $facebook_login_url = $helper->getLoginUrl(url('facebook/login'), $permissions);
    //     return view('facebook.login', compact('facebook_login_url'));
    // }

    protected function postFacebookLogin(FacebookService $facebook)
    {
        // Try to connect to Facebook and get the user's information
        try {
            $facebook->connect();
        } catch(Exception $e) {
            flash()->warning('There was a problem connecting with Facebook: ' . $e->getMessage());
            return redirect()->back();
        }

        // Check if the user has already connected the app with Facebook
        $profile = Profile::where('facebook_id', $facebook->id)->first();
        if($profile) {
            auth()->login($profile->user());
            return redirect('submissions');
        }

        // Otherwise create/connect a User account
        $user = User::where('email', $facebook->email)->firstOrCreate([
            'email' => $facebook->email,
            'password' => $facebook->accessToken
        ]);
        
        // Create a new Profile
        $profile = new Profile($facebook->profile);
        $user = $user->profile()->save($profile);
        
        // And log in
        auth()->login($user);
        return redirect('submissions');
    }

}
