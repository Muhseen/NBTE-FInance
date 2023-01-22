<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title ?? 'Finance Module' }}</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ url('css/all.min.css') }}"> {{-- font awesome --}}
	<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
	<!-- Theme Style -->
	<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/summernote.min.js') }}" type="text/javascript"></script>
	<link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6/dist/css/bootstrap.min.css" />
	<script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"></script>


	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

<body class="hold-transition sidebar-mini">

	<div class="wrapper">
		@include('partials.nav')
		@include('partials.sidemenu')
		<div class="content-wrapper mt-3">


			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					@yield('content')
				</div>
			</section>
			<!-- /.content -->
		</div>
		<footer class="main-footer">

			<strong>NBTE Finance Module &copy; 2022. All rights reserved.
		</footer>
	</div>
</body>
<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('js/adminlte.min.js') }}"></script>
<script defer>
	$(document).ready(function() {
		$(".select2").select2({})
		$('.summernote').summernote();
	});
</script>

</html>
