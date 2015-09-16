<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Profile;
use App\Repositories\UserRepository;

class UserRepositoryContract implements UserRepository {

	/**
	 * Create new UserRepository instance
	 * @param User $user
	 */
	function __construct(User $user) {
		$this->user = $user;
	}

	/**
	 * [findByEmail description]
	 * @param  [type] $email [description]
	 * @return [type]        [description]
	 */
	public function findByEmail($email) {
		return $this->user->where('email', $email)->first();
	}

	/**
	 * [findByFacebookId description]
	 * @param  [type] $facebook_id [description]
	 * @return [type]              [description]
	 */
	public function findByFacebookId($facebook_id) {
		if($profile = Profile::where('facebook_id', $facebook_id)->first()) {
			return $profile->user;
		}
	}

	/**
	 * [create description]
	 * @param  array  $attributes [description]
	 * @return [type]             [description]
	 */
	public function create(array $attributes) {
		$user = $this->user->newInstance($attributes);
		$user->password = bcrypt($attributes['password']);
		$user->save();
		return $user;
	}

	/**
	 * [createAndLogin description]
	 * @param  array  $attributes [description]
	 * @return [type]             [description]
	 */
	public function createAndLogin(array $attributes) {
		return auth()->login($this->create($attributes));
	}

	/**
	 * [update description]
	 * @param  User   $user       [description]
	 * @param  array  $attributes [description]
	 * @return [type]             [description]
	 */
	public function update(User $user, array $attributes) {
		return $user->update($attributes);
	}

	/**
	 * [makeAdmin description]
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function makeAdmin(User $user) {
		$user->is_admin = true;
	}

	/**
	 * [removeAdmin description]
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function removeAdmin(User $user) {
		$user->is_admin = false;
	}
	
}