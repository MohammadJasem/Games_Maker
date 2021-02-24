@extends('layouts.master_page')

@section('title','Welcome')

@section('content')


<div class="bgimg" style="background-image: url('{{url('img/welcome_1.jpg')}}');height: 100%">
	<div class="ui container" style="padding-top: 30px">
		<div class="ui secondary  menu">
			<div class="right menu">
	    		<a href="{{route('login')}}" class="ui teal button item">
			      <span style="font-size: 18px;color:white;"><b>Login</b></span>
			    </a>
			    <a href="{{route('register')}}" class="ui button item">
			      <span style="font-size: 18px;color:white;"><b>Register</b></span>
			    </a>
	  		</div>
		</div>
	</div>
</div>


@stop
