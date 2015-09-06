@extends('main.layout')

@section('title', ' - Welcome')

@section('content')
<div class="welcome">
    <div class="container">
        <div class="content">
            <div class="title">Joel's Quit App</div>          
            <div class="row">
                <a href="{{url('auth/login')}}">Login</a>
                <span> | </span>
                <a href="{{url('auth/register')}}">Register</a>
            </div>
        </div>
    </div>
</div>
@stop