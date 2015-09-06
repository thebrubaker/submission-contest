<?php

namespace App\Repositories;

use App\User;
use App\Submission;

interface VoteRepository {
	public function castVote(User $user, Submission $submission);
	public function checkCanVote(User $user, Submission $submission);
	public function getTotalVotes(Submission $submission);
}