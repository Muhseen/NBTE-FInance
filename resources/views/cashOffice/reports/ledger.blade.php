@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row">
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">
			</div>
			<div class="col-10 text-center">
				<h2>National Board for Technical Education</h2>
				<h4>Account Ledger</h4>
			</div>
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">

			</div>
		</div>

		<div class="row">
			<div class='text-center col-12'>
				<h4>for</h4>
				<h5>
					Account Name: {{ $code->LineItem }} <br>
					Account Code: {{ $code->EconSegCode }} <br>

				</h5>
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
						<td>{{ $item->narration }}</td>
						<td>{{ Str::currency($item->amount_cr) }}</td>
						<td>{{ Str::currency($item->amount_db) }}</td>
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
				<tr>
					<td colspan="4" class="text-right">Total Outstanding</td>
					<td>{{ Str::currency($total) }}</td>
				</tr>
			</table>
		</div>
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>

	</div>
@endsection
