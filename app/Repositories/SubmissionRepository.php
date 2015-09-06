<?php

namespace App\Repositories;

use App\User;
use App\Submission;

interface SubmissionRepository {

	public function findAllForUser(User $user, $per_page = null);
	public function findAll($per_page = 10);
	public function findByMostVotes();
	public function findByMostRecent();
	public function findByUnapproved();
	public function findByDenied();
	public function findByFriendSubmissions(User $user);
	public function create(User $user, array $input);
	public function update(Submission $submission, array $input);
	
}