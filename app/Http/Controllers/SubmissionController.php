<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Submissions\CreateRequest;
use App\Http\Requests\Submissions\UpdateRequest;
use App\Repositories\SubmissionRepository;
use App\Submission;
use App\User;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{

    /**
     * Submission Repository
     * @var App\Repositories\SubmissionRepository
     */
    private $repository;

    /**
     * Create Submission Repository instance
     * @param SubmissionRepository $repository [description]
     */
    function __construct(SubmissionRepository $repository) {
        $this->repository = $repository;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $submissions = Submission::all()->sortByDesc('created_at');
        return view('submissions.index', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('submissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubmissionRequest  $request
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $submission = new Submission($request->all());
        $submission = auth()->user()->submit($submission);
        return redirect('submissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $submission = Submission::find($id);
        return view('submissions.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $submission = Submission::findOrFail($id);
        return view('submissions.edit', compact('submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateRequest $request)
    {
        $submission = Submission::findOrFail($id);
        $submission->caption = $request->get('caption');
        $submission->location = $request->get('location');
        $submission->save();
        return redirect('submissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Submission::destroy($id);
        return redirect('submissions');
    }

    public function castVote($id)
    {
        $user = auth()->user();
        $submission = Submission::find($id);

        if($user->canVote($submission)) {
            $user->castVote($submission);
            // Success
            return redirect()->back();
        }
        
        // Failure
        return redirect()->back();
    }
}
