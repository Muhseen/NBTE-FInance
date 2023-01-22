@extends('layouts.app')
@section('content')
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container card p-3">
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>
		<div class='card  text-center card-header'>
			<h1>Ledger for</h1>
			<h2>
				Account Name: {{ $code->description }} <br>
				Account Code: {{ $code->code }} <br>

			</h2>
			<p>Generated on {{ now()->toDateString() }}</p>
		</div>

		<table class='table text-center table-striped table-hover table-bordered'>
			<tr>
				<th>Date</th>
				<th>Description</th>
				<th>Narration</th>
				<th>Amount Dr</th>
				<th>Amount Cr</th>
				{{-- <th>Balance(To be paid)</th> --}}

			</tr>
			@php
				$total = 0;
			@endphp
			@foreach ($report as $item)
				<tr>
					<td>{{ Str::date($item->txn_date) }}</td>
					<td>{{ $item->description }}</td>
					<td>{{ $item->description }}</td>
					<td>{{ $item->narration }}</td>
					<td>{{ Str::scurrency($item->amount_db) }}</td>
					<td>{{ Str::currency($item->amount_cr) }}</td>

					@php
						$total += $item->amount_cr - $item->amount_db;
					@endphp
					{{-- <td>{{ Str::currency($total) }}</td> --}}
				</tr>
			@endforeach
			@if ($report->count() == 0)
				<tr>
					<td colspan="4">No Transactions</td>
					<td> 0.00</td>
				</tr>
			@endif

		</table>
	</div>
@endsection
