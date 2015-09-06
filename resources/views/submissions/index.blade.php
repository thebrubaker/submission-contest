@extends('main.layout')

@section('content')
<h3>Number of Submissions: {{$submissions->count()}}</h3>
@foreach($submissions as $submission)
<p>ID: {{$submission->id}} | Caption: {{$submission->caption}}</p>
@endforeach

@endsection