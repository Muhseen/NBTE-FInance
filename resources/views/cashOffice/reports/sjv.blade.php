@extends('layouts.main')
@section('content')
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container card p-3">
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>

		<div class="row">
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">
			</div>
			<div class="col-10 text-center">
				<h2>National Board for Technical Education</h2>
				<h3 class="text-cneter">Standard Jouranl Voucher</h3>
				<h3>{{ $month . ',' . $year }}</h3>
				<h3>Account Code: {{ $code }} Description : {{ $desc }}</h3>
				<p>Generated on {{ now()->toDateString() }}</p>
			</div>
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">

			</div>
		</div>


		<table class='table text-center table-striped table-hover table-bordered'>
			<tr>
				<th>Description</th>
				<th>Code</th>
				<th>Dr</th>
				<th>Cr</th>
			</tr>
			@php
				$total = 0;
			@endphp
			@foreach ($reports as $item)
				<tr>
					<td>{{ $item->description ?? 'N/A' }}</td>
					<td>{{ $item->code ?? 'N/A' }}</td>
					<td>{{ Str::currency($item->amount_db) }}</td>
					<td>{{ Str::currency($item->amount_cr) }}</td>
					{{-- <td>{{ Str::currency($total) }}</td> --}}
				</tr>
			@endforeach
			@if ($reports->count() == 0)
				<tr>
					<td colspan="2">No Transactions</td>
					<td> 0.00</td>
					<td> 0.00</td>
				</tr>
			@endif
			{{--  <tr>
					<td colspan="4" class="text-right">Total Outstanding</td>
					<td>{{ Str::currency($total) }}</td>
				</tr> --}}
		</table>

	</div>
@endsection
