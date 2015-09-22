<?php

namespace App\Services;

use Facebook\Facebook;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookService {

	/**
	 * @const string The Facebook App ID for connecting users
	 */
	const APP_ID = '949704785045810';

	/**
	 * @const string The Facebook App Secret for connecting users
	 */
	const APP_SECRET = '234413690aff34d4dc37d1cab12c646b';

	/**
	 * @const string The Facebook Graph Version for connecting users
	 */
	const GRAPH_VERSION = 'v2.4';

	/**
	 * A Facebook object instance
	 * @var Facebook\Facebook;
	 */
	protected $facebook;

	/**
	 * Attributes that should be collected from a user when requesting their profile
	 * @var array
	 */
	protected $attributes = ['first_name','last_name','email','devices','location','age_range','hometown','id','gender'];

	/**
	 * The user's Facebook access token
	 * @var string
	 */
	public $accessToken;

	/**
	 * The user's Facebook id
	 * @var string
	 */
	public $id;

	/**
	 * The user's email address
	 * @var string
	 */
	public $email;

	/**
	 * The user's Facebook profile information
	 * @var array
	 */
	public $profile = [];

	/**
	 * Instantiate a new Facebook Service object
	 */
	function __construct() {
		$this->facebook = new Facebook([
			'app_id' => static::APP_ID, 
			'app_secret' => static::APP_SECRET, 
			'default_graph_version' => static::GRAPH_VERSION
		]);
	}

	/**
	 * Connect with the user's Facebook acccount
	 * @return null
	 */
	public function connect()
	{
		$this->setAccessToken();
		$this->setUserProfile();
	}

	/**
	 * Set the Facebook user's access token
	 * @return null
	 */
	public function setAccessToken()
	{
		try {
			// Try to set the access token from the user
			$accessToken = $this->facebook->getJavaScriptHelper()->getAccessToken();
		} catch(FacebookResponseException $e) {
			// When Graph returns an error
			throw new Exception('Graph returned an error: ' . $e->getMessage());
		} catch(FacebookSDKException $e) {
			// When validation fails or other local issues
			throw new Exception('Facebook SDK returned an error: ' . $e->getMessage());
		}
		if (!isset($accessToken)) {
			throw new Exception('No cookie set or no OAuth data could be obtained from cookie.');
		}
		// Set the user's access token
		$this->accessToken = (string) $accessToken;
		// Save the user's access token in the session for use with javascript
		session()->set('fb_access_token', $this->accessToken);
		return $this->accessToken;
	}

	/**
	 * Get the user's Facebook access token
	 * @return string
	 */
	public function getAccessToken()
	{
		return $this->accessToken;
	}

	public function getProfile()
	{
		$profile_data = $fb->get('/me?fields=first_name,last_name,email,devices,location,age_range,hometown,id,gender', $accessToken)->getDecodedBody();
		$user_picture = $fb->get('/me/picture?redirect=false', $accessToken)->getDecodedBody()['data']['url'];

		$this->profile['first_name'] = array_key_exists('first_name', $profile_data) ? $profile_data['first_name'] : NULL;
		$this->profile['last_name'] = array_key_exists('last_name', $profile_data) ? $profile_data['last_name'] : NULL;
		$this->profile['location'] = array_key_exists('location', $profile_data) ? $profile_data['location'] : NULL;
		$this->profile['hometown'] = array_key_exists('hometown', $profile_data) ? $profile_data['hometown'] : NULL;
		$this->profile['gender'] = array_key_exists('gender', $profile_data) ? $profile_data['gender'] : NULL;
		$this->profile['devices'] = array_key_exists('devices', $profile_data) ? $profile_data['devices'] : NULL;
		$this->profile['age_range'] = array_key_exists('age_range', $profile_data) ? $profile_data['age_range'] : NULL;
		$this->profile['facebook_id'] = $profile_data['id'];
		$this->profile['access_token'] = $token;
		$this->profile['profile_photo'] = $user_picture;
	}
}