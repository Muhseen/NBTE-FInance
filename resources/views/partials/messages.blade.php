@if ($errors->any())
	@foreach ($errors->all() as $error)
		<div class="alert alert-nbte-error alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{ $error }}
		</div>
	@endforeach
@endif
@if (session()->has('message'))
	<div class="alert alert-nbte-success alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		{{ session('message') }}
	</div>
@endif
