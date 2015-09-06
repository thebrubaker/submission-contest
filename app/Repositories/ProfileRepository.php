<?php

namespace App\Repositories;

use App\User;
use App\Profile;

interface ProfileRepository {

	public function findByFacebookId($facebook_id);
	public function create(Profile $profile, array $input);
	public function update(Profile $profile, array $input);
	public function updateToken(Profile $profile, $token);
	
}