@extends('main.layout')

@section('content')
<div class="container">
	<h1>Deer Camp Champ</h1>
	<p><a href="/submissions/create">Create a Submission</a></p>
	<p><a href="/submissions">View Submissions</a></p>
	<p><a href="/auth/login">Login</a></p>
	<p><a class="btn btn-default" href="/auth/register">Sign Up Using Email</a></p>
	<p><button class="btn btn-primary" onClick="logInWithFacebook()">Continue With Facebook</button></p>
	<form action="{{url('facebook/login')}}" method="post" id="facebook-login">
		{!! csrf_field() !!}
	</form>

	<script>
		logInWithFacebook = function(e) {
			FB.login(function(response) {
				if (response.authResponse) {
					console.log('You are logged in & cookie set!');
					$('#facebook-login').submit();
				} else {
					alert('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'email,user_friends'});
			return false;
		};
		
		window.fbAsyncInit = function() {
			FB.init({
				appId: '949704785045810',
				cookie: true, // This is important, it's not enabled by default
				version: 'v2.4'
			});
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
</div>
@endsection