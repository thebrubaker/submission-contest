@extends('main.layout')

@section('content')
<a href="{{route('submissions.index')}}">All Submissions</a>

<div class="title">Edit Submission</div>
<img src="{{url($submission->thumbnail_path)}}" width="50" height="50">
<form method="POST" action="{{route('submissions.update', ['id' => $submission->id])}}">
<input name="_method" type="hidden" value="PATCH">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>There were some errors with your submission:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="caption" class="sr-only">Caption</label>
        <input type="text" id="caption" name="caption" value="{{ (old('caption')) ? old('caption') : $submission->caption }}" placeholder="Caption" class="form-control">
    </div>
    <div class="form-group">
        <label for="location" class="sr-only">Location</label>
        <input type="text" id="location" name="location" value="{{ (old('location')) ? old('location') : $submission->location }}" placeholder="Location" class="form-control">
    </div>
    <input type="hidden" id="id" name="id" value="{{ $submission->id }}" placeholder="Location" class="form-control">
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Update</button>
    </div>
</form>

@endsection