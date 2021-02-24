<!DOCTYPE html>
<html>
<head>
	
	<link rel="icon" href="{{url('icon_1.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('icon_1.ico')}}" type="image/x-icon">

	<title>@yield('title')</title>

	@include('layouts._styles')
	@yield('myStyles')

	

</head>
<body style="background-color: rgb(236,240,241)">
	<div class="gm-loader" style="display: none;">
        <div class="preloader">
            <div class="hollow-dots-spinner" :style="spinnerStyle">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
	@yield('content')

	@include('layouts._scripts')
	@yield('myScripts')

	@include('layouts.modal')

</body>
</html>