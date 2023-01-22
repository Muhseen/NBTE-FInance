@extends('layouts.mainAuth')

@section('content')
	<!--Start LoginBox -->
	@include('partials.messages')
	<div class="login-box">

		<div class="card card-outline card-nbte">
			<div class="card-header text-center">
				<span class="h1"><b>Finance Module</b></span>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Please Sign In Using Your Credentials</p>

				<form action="{{ route('login') }}" method="post" autocomplete="off">

					@if (Session::get('fail'))
						<div class="alert alert-nbte-error alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							{{ Session::get('fail') }}
						</div>
					@endif
					@csrf
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
						<input type="text" name="username" class="form-control" placeholder="User ID" value="{{ old('userID') }}">
					</div>
					<span class="text-danger">
						@error('userID')
							{{ $message }}
						@enderror
					</span>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<span class="text-danger">
						@error('password')
							{{ $message }}
						@enderror
					</span>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-nbte btn-block">Sign In</button>
						</div>
					</div>

				</form>

			</div>
		</div>

	</div>
	<!--End LoginBox -->
@endsection
