@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row">
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">
			</div>
			<div class="col-10 text-center">
				<h2>National Board for Technical Education</h2>
				<h4>Trial Balance for January to December</h4>
			</div>
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">

			</div>
		</div>

		<div class="row">
			<div class='text-center col-12'>
				<p>Generated on {{ now()->toDateString() }}</p>
			</div>

			<table class="table table-striped table-bordered table-active">
				<tr>
					<th>Account Code</th>
					<th>Amount Dr</th>
					<th>Amount Cr</th>
				</tr>
				{!! $tr !!}
				<tr>
					<th>Totals</th>
					<th>{{ Str::currency($tots[0]) }}</th>
					<th>{{ Str::currency($tots[1]) }}</th>
				</tr>
			</table>
		</div>


	</div>
@endsection
