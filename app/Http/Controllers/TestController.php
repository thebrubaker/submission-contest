<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class TestController extends Controller
{
	private $repository;

	function __construct(UserRepository $repository) {
		$this->repository = $repository;
	}

	public function getTest()
	{
		dd($this->repository);
	}

}