<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Submission;
use App\Repositories\SubmissionRepository;

class SubmissionRepositoryContract implements SubmissionRepository {

	private $submission;

	function __construct(Submission $submission) {
		$this->submission = $submission;
	}

	public function findAllForUser(User $user, $per_page = null) {
		$query = $this->submission->query()->where($user);
		return $this->getQuery($query, $per_page);
	}

	public function findAll($per_page = null) {
		$query = $this->submission->query();
		return $this->getQuery($query, $per_page);
	}

	public function findByMostVotes($per_page = null) {
		$query = $this->submission->query()->orderBy('vote_cache', 'desc');
		return $this->getQuery($query, $per_page);
	}

	public function findByMostRecent($per_page = null) {
		$query = $this->submission->query()->orderBy('created_at', 'desc');
		return $this->getQuery($query, $per_page);
	}

	public function findByUnapproved($per_page = null) {
		$query = $this->submission->query()->where('approved', 'null')->orderBy('created_at', 'desc');
		return $this->getQuery($query, $per_page);
	}

	public function findByDenied($per_page = null) {
		$query = $this->submission->query()->where('approved', 'false')->orderBy('created_at', 'desc');
		return $this->getQuery($query, $per_page);
	}

	public function findByFriendSubmissions(User $user, $per_page = null) {

	}

	public function create(User $user, array $attributes) {
		$submission = $this->submission->newInstance($attributes);
		dd($submission);
		return $submission->user()->save($user);
	}

	public function update(Submission $submission, array $attributes) {
		return $submission->update($attributes);
	}
	
	private function getQuery($query, $per_page) {
		if($per_page) {
			return $query->paginate($per_page);
		}
		return $query->get();
	}
		
}