<?php

namespace App\Http\Controllers\Auth;

use Validator;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Facebook\Facebook;
use Facebook\Authentication\AccessToken;

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

    protected function getFacebookLogin()
    {
        $fb = new Facebook([
            'app_id' => '{app-id}',
            'app_secret' => '{app-secret}',
            'default_graph_version' => 'v2.4',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $url = $helper->getLoginUrl(url('facebook/login'), $permissions);
        return view('facebook.login', compact('url'));
    }

    protected function postFacebookLogin(Request $request)
    {
        # /js-login.php
        $fb = new Facebook([
            'app_id' => '949704785045810',
            'app_secret' => '234413690aff34d4dc37d1cab12c646b',
            'default_graph_version' => 'v2.4',
        ]);

        $helper = $fb->getJavaScriptHelper();

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        if (! isset($accessToken)) {
          echo 'No cookie set or no OAuth data could be obtained from cookie.';
          exit;
        }

        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

        echo '<h2>Is Long Lived?';
        var_dump($accessToken->isLongLived());

        $_SESSION['fb_access_token'] = (string) $accessToken;

        $profile_data = $fb->get('/me?fields=first_name,last_name,email,devices,location,age_range,hometown,id,gender', (string) $accessToken);
        $user_picture = $fb->get('/me/picture?redirect=false', (string) $accessToken);

        var_dump($profile_data->getDecodedBody());
        var_dump($user_picture->getDecodedBody());

        // User is logged in!
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
        
        // $user = Profile::where('facebook_id', $request->get('id'))->user()->first();
        // if(!$user) {
        //     $data = Facebook::profileById($request->get('id'));
        //     $user = User::create($data['email']);
        //     $profile = new Profile($data);
        //     $user->profile()->save($profile);
        // }
        // auth()->login($user);
    }

}
