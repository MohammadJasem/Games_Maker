@extends('layouts.master_page')

@section('title','Login')

@section('content')

<div class="bgimg" style="background-image: url('{{url('img/login_reg.jpg')}}');">
	<div class="ui grid" style="padding-top: 12%;">
		<div class="six wide centered column">
			<form method="post" action="loginUser">
				<div class="ui form segment">
					@if(isset($errorMsg)&&$errorMsg!='')
					    <div class="ui error visible message">
					    	<div class="header">{{$errorMsg}}</div>
					    </div>
				    @endif
				    <div class="field">
				        <label for="username">Username</label>
				        <div class="ui corner labeled input">
				        	@if(isset($data['username']))
				        		<input type="text" name="username" placeholder="Username" value="{{$data['username']}}" >
				        	@else
				        		<input type="text" name="username" placeholder="Username" >
				        	@endif
						  @include('partials.req_star')
						</div>
						@if(isset($errors['username']))
							<label id="username-error" class="error" for="username">{{$errors['username']}}</label>
						@endif
				    </div>
				    <div class="field">
				        <label for="password">Password</label>
				        <div class="ui corner labeled input">
						  <input name="password" type="password">
						  @include('partials.req_star')
						</div>
						@if(isset($errors['password']))
							<label id="password-error" class="error" for="password">{{$errors['password']}}</label>
						@endif
				    </div>
				   
				    <button class="ui blue submit button" type="submit">Login</button>
			  		<span class="ui">I don't have an account. <a href="{{route('register')}}">Create an account</a></span>
				</div>
			</form>
		</div>
	</div>
</div>

@stop