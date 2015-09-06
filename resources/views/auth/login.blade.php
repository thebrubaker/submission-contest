@extends('main.layout')

@section('content')
<form action="/auth/login" method="POST" class="">
    @if(count($errors) > 0)
    <div class="alert alert-danger">
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
        <button type="submit" class="btn btn-primary form-control">Log in</button>
    </div>
    <div class="form-group form-inline">
        <div class="checkbox">
            <label><input type="checkbox"> Remember Me</label>
        </div>
    </div>
</form>
</div>
<div class="row">
<p><a href="/password/email">Forgot Your Password?</a></p>
</div>
@endsection