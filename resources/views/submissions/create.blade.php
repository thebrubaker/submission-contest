@extends('main.layout')

@section('content')

<div class="title">New Submission</div>
<form method="POST" enctype="multipart/form-data">
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
        <label for="image">Image</label>
        <input type="file" id="image" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="caption" class="sr-only">Caption</label>
        <input type="text" id="caption" name="caption" placeholder="Caption" class="form-control">
    </div>
    <div class="form-group">
        <label for="location" class="sr-only">Location</label>
        <input type="text" id="location" name="location" placeholder="Location" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Submit</button>
    </div>
</form>

@endsection