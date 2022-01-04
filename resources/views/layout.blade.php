<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fontawesome/css/all.css') }}" rel="stylesheet">

    <style type="text/css">
    	a {
    		text-decoration: none;
    		color: black;
    	}

    	a:hover {
    		text-decoration: none;
    		color: black;
    	}

    	.container {
    		margin-top: 10px;
    	}
    </style>
</head>
<body>
	@section('content')

	@show
</body>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('plugins/fontawesome/js/all.js') }}"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

@section('javascript')
@show

</html>