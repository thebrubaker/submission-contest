<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Submission;
use Intervention\Image\Image;
use App\Repositories\SubmissionRepository;
use App\Utilities\ImageUtility;

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

	public function create(User $user, array $attributes, Image $image) {
		$image_path = ImageUtility::create($image);
		$thumbnail_path = ImageUtility::thumbnail($image);
		$submission = $this->submission->newInstance($attributes);
		$submission->image_path = $image_path;
		$submission->thumbnail_path = $thumbnail_path;
		return $user->submissions()->save($submission);	
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