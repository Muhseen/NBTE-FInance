<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Finance Module | Log In</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ url('css/all.min.css') }}"> {{-- font awesome --}}
	<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
	<!-- Theme Style -->
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">



	<style>
		.card-nbte.card-outline {
			border-top: 4px solid #00913e;
		}

		.btn-nbte {
			color: #fff;
			background-color: #00913e;
			border-color: #00913e;
			box-shadow: none;
		}

		.alert-nbte-error {
			color: #fff;
			background-color: #d9220a;
			border-color: #d9220a;
			border-radius: 0;
			border-left: 5px solid #891405;
		}
	</style>

</head>

<body class="hold-transition login-page">

	@yield('content')


</body>
<!-- jQuery -->
<script src="{{ url('js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('js/adminlte.min.js') }}"></script>

</html>
