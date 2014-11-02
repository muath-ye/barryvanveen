<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<base href="{{ url() }}/">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic' rel='stylesheet' type='text/css'>

	{{ HTML::style('css/screen.css', ['media' => 'screen']) }}
	{{ HTML::style('css/print.css', ['media' => 'print']) }}

	@include('layouts.partials.javascript')

	<!--[if lte IE 8]>
		{{ HTML::script('js/main.ie8.min.js') }}
	<![endif]-->

	</head>
	<body>

		<div class="page">

			@include('layouts.partials.header')

			@yield('body')

		</div>

		{{ HTML::script('js/main.min.js') }}

	</body>
	</html>