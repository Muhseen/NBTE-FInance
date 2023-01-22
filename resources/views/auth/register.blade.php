@extends('layouts.main')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Add New User') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('register') }}">
							@csrf

							<div class="row mb-3">
								<label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
										value="{{ old('name') }}" required autocomplete="name" autofocus>

									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3">
								<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

								<div class="col-md-6">
									<input id="email" type="username" class="form-control @error('username') is-invalid @enderror"
										name="username" value="{{ old('username') }}" required autocomplete="email">

									@error('username')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-md-4 col-form-label text-md-end">{{ __('File No') }}</label>

								<div class="col-md-6">
									<input type="username" class="form-control @error('file_no') is-invalid @enderror" name="file_no"
										value="{{ old('file_no') }}">

									@error('file_no')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row mb-3">
								<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Unit') }}</label>

								<div class="col-md-6">
									<select id="unit" type="unit" class="form-control @error('unit') is-invalid @enderror" name="unit"
										value="{{ old('email') }}">
										<option value="Audit">Audit</option>
										<option value="Expediture Control">Expenditure Control</option>
										<option value="Loans and Advances">Loans And Advances</option>
										<option value="Cash Office">Cash Office</option>
										<option value="Budget">BUdget Office</option>
									</select>
									@error('unit')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3">
								<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
										name="password" required autocomplete="new-password">

									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
										autocomplete="new-password">
								</div>
							</div>

							<div class="row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Register') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
