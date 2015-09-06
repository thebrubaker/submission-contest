<?php

namespace App\Repositories;

use App\User;

interface UserRepository {

	public function findByEmail($email);
	public function findByFacebookId($facebook_id);
	public function create(array $input);
	public function createAndLogin(array $input);
	public function update(User $user, array $input);
	public function makeAdmin(User $user);
	public function removeAdmin(User $user);
	
}