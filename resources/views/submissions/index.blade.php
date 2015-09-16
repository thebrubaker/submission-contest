@extends('main.layout')

@section('content')
<a href="{{route('submissions.create')}}">Create</a>
<h3>Number of Submissions: {{$submissions->count()}}</h3>
@foreach($submissions as $submission)
<p>
	<img src="{{url($submission->thumbnail_path)}}" width="50" height="50">
	ID: {{$submission->id}} | Caption: {{$submission->caption}} | Votes: {{$submission->vote_cache}}
	<a href="{{route('submissions.show', ['id' => $submission->id])}}">View</a>
	<a href="{{route('submissions.edit', ['id' => $submission->id])}}">Edit</a>
	<form method="post" action="{{route('submissions.castVote', ['id' => $submission->id])}}">
		{!! csrf_field() !!}
		<button type="submit">Vote</button>
	</form>
	<form method="post" action="{{route('submissions.destroy', ['id' => $submission->id])}}">
		<input name="_method" type="hidden" value="DELETE">
		{!! csrf_field() !!}
		<button type="submit">Delete</button>
	</form>
</p>
@endforeach

@endsection