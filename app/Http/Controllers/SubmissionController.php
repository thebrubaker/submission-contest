<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SubmissionRepository;

use App\Submission;
use App\Http\Requests\SubmissionRequest;

class SubmissionController extends Controller
{

    private $submissions;

    function __construct(SubmissionRepository $submissions) {
        $this->submissions = $submissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return view('submissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postCreate(SubmissionRequest $request)
    {
        dd($request->all());
    }

    public function getSubmissions()
    {
        $submissions = $this->submissions->findAll();
        return view('submissions.index', compact('submissions'));
    }
}
