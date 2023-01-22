@extends('layouts.app')
@section('content')
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container card p-3">
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>
		<div class='card  text-center card-header'>
			<h1>SJV For</h1>
			<h5> {{ $startDate }} to {{ $endDate }}</h5>
			<h2>
				Account Name: {{ $desc }} <br>
				Account Code: {{ $code }} <br>

			</h2>
			<p>Generated on {{ now()->toDateString() }}</p>
		</div>

		{!! $table !!}
		<div class="row my-3">
			<div class="col-6">Prepared By .....................................................................................
			</div>
			<div class="col-6">Checked By ......................................................................................
			</div>

		</div>
		<div class="row">
			<div class="col-3">Sign .....................</div>
			<div class="col-3">Date ....................</div>
			<div class="col-3">Sign .....................</div>
			<div class="col-3">Date .....................</div>
		</div>
		<div class="row text-center my-3">
			<div class="col-4 offset-4">
				Approved By ............................................... <br>
				NAME ...................................................... <br>
				Sign.........................Date .........................
			</div>
		</div>
	</div>
@endsection
