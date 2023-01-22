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
				<h4>{{ $header ?? 'Payment Reports' }}</h4>
				<p>Generated on {{ now()->toDateString() }}</p>
			</div>

			<table class='table text-center table-striped table-hover table-bordered'>
				<tr>
					<th>Date</th>
					<th>Payer</th>
					<th>Narration</th>
					<th>Paid Into</th>
					<th>Amount</th>

				</tr>
				@php
					$total = 0;
				@endphp
				@foreach ($report as $item)
					<tr>
						<td>{{ Str::date($item->txn_date) }}</td>
						<td>{{ $item?->voucher->payee ?? '' }}</td>
						<td>{!! $item?->voucher->description ?? $item->narration !!}</td>
						<td>{{ $item->funding_account == '31020101' ? 'Capital' : 'Overhead' }}</td>
						<td>{{ Str::currency($item->amount) }}</td>
						@php
							$total += $item->amount;
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
					<td colspan="4" class="text-right">Total :</td>
					<td>{{ Str::currency($total) }}</td>
				</tr>
			</table>
		</div>
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>

	</div>
@endsection
