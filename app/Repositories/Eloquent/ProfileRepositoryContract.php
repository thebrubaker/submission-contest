<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Submission;
use App\Repositories\ProfileRepository;

class ProfileRepository implements ProfileRepository {

	public function findAllForUser(User $user, $per_page = null);
	public function findAllPaginated($per_page = 10);
	public function findByMostVotes();
	public function findByMostRecent();
	public function findByUnapproved();
	public function findByDenied();
	public function findByFriendSubmissions(User $user);
	public function create(User $user, array $input);
	public function update(User $user, array $input);
	public function checkIfUserVoted(User $user, Submission $submission);
	
}