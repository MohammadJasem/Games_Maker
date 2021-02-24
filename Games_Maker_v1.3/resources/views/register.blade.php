@extends('layouts.master_page')

@section('title','Register')

@section('content')

<div class="bgimg" style="background-image: url('{{url('img/login_reg.jpg')}}');height: 100%">
	<div class="ui grid" style="padding-top: 5%;">
		<div class="seven wide centered column">
			<form method="post" action="registerUser">
				<div class="ui form segment">
					@if(isset($errorMsg)&&$errorMsg!='')
					    <div class="ui error visible message">
					    	<div class="header">{{$errorMsg}}</div>
					    </div>
				    @endif
				  <p>Let's go ahead and get you signed up.</p>
				  <div class="two fields">
				    <div class="field">
				    	<label>First Name</label>
				    	<div class="ui corner labeled input">
				    		@if(isset($data['firstname']))
				      			<input type="text" name="firstname" value="{{$data['firstname']}}" placeholder="First Name">
			      			@else
				      			<input type="text" name="firstname" value="" placeholder="First Name">
			      			@endif
			      			@include('partials.req_star')
			  			</div>
			  			@if(isset($errors['firstname']))
							<label id="firstname-error" class="error" for="firstname">{{$errors['firstname']}}</label>
						@endif
				    </div>
				    <div class="field">
				      	<label>Last Name</label>
				      	<div class="ui corner labeled input">
				    		@if(isset($data['lastname']))
				      			<input type="text" name="lastname" value="{{$data['lastname']}}" placeholder="Last Name">
			      			@else
				      			<input type="text" name="lastname" value="" placeholder="Last Name">
			      			@endif
			      			@include('partials.req_star')
			  			</div>
			  			@if(isset($errors['lastname']))
							<label id="lastname-error" class="error" for="lastname">{{$errors['lastname']}}</label>
						@endif
				    </div>
				  </div>
				  <div class="field">
					<label>Username</label>
					<div class="ui corner labeled input">
			    		@if(isset($data['username']))
			      			<input type="text" name="username" value="{{$data['username']}}" placeholder="User Name">
		      			@else
			      			<input type="text" name="username" value="" placeholder="User Name">
		      			@endif
		      			@include('partials.req_star')
		  			</div>
		  			@if(isset($errors['username']))
						<label id="username-error" class="error" for="username">{{$errors['username']}}</label>
					@endif
				  </div>
				  <div class="field">
					<label>Password</label>
					<div class="ui corner labeled input">
				    	<input name="password" type="password">
				    	@include('partials.req_star')
				    </div>
				    @if(isset($errors['password']))
						<label id="password-error" class="error" for="password">{{$errors['password']}}</label>
					@endif
				  </div>
				  <div class="field">
					<label>Confirm Password</label>
					<div class="ui corner labeled input">
				    	<input name="confirm_password" type="password">
				    	@include('partials.req_star')
				    </div>
				    @if(isset($errors['confirm_password']))
						<label id="confirm_password-error" class="error" for="confirm_password">{{$errors['confirm_password']}}</label>
					@endif
				  </div>
				  <div class="inline field">
				    <div class="ui checkbox">
				      <input name="terms" type="checkbox">
				      <label>I agree to the terms and conditions</label>
				    </div>
				  </div>
				  <button class="ui blue submit button" type="submit">Register</button>
				  <span class="ui">I'm already have an account. <a href="{{route('login')}}">Login</a></span>
				</div>
			</form>
		</div>
	</div>
</div>

@stop
