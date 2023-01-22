@extends('layouts.app')
@section('content')
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container card p-3">
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>
		<div class='row card text-center card-header'>
			<h1>SMK Medical Center</h1>
			<h5> Trial Balance</h5>
			<p>Generated on {{ now()->toDateString() }}</p>
		</div>

		{!! $table !!}

	</div>
@endsection
