<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Submission;
use App\Repositories\VoteRepository;

class VoteRepository implements VoteRepository {

	/**
	 * Cast a vote for a user on a submission
	 * @param  User       $user       [description]
	 * @param  Submission $submission [description]
	 * @return [type]                 [description]
	 */
	public function castVote(User $user, Submission $submission) {
		if($vote = $user->votes()->whereSubmissionId($submission->id)->first()) {
			vote->value++;
			vote->save();
		} else {
			$user->votes()->save($submission);
		}
	}

	public function getTotalVotes(Submission $submission) {

	}

	public function checkCanVote(User $user, Submission $submission)
	{
		
	}
		}
}