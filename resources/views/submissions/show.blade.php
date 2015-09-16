@extends('main.layout')

@section('content')
<a href="{{route('submissions.index')}}">All Submissions</a>
<a href="{{route('submissions.create')}}">Create</a>
<a href="{{route('submissions.edit', ['id' => $submission->id])}}">Edit</a>
<p>ID: {{$submission->id}} | Caption: {{$submission->caption}}</p>
<img src="{{url($submission->image_path)}}" width="600">
<form method="post" action="{{route('submissions.destroy', ['id' => $submission->id])}}">
	<input name="_method" type="hidden" value="DELETE">
	{!! csrf_field() !!}
	<button type="submit">Delete</button>
</form>

@endsection