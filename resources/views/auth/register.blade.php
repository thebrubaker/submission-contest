@extends('main.layout')

@section('title', ' - Register')

@section('content')

<div class="title">New Account</div>
<form action="{{url('auth/register')}}" method="POST">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>There were some errors with your registration:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="email" class="sr-only">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirmation" class="sr-only">Password Confirmation</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Register</button>
    </div>
</form>
@stop