@extends('layouts.app')
@section('content')
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container card p-3">
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>
		@foreach ($ledgers as $ledger)
			<div class='card  text-center card-header my-5'>
				<h1>Ledger for</h1>
				<h2>
					Account Name: {{ $ledger->code->description }} <br>
					Account Code: {{ $ledger->code->code }} <br>

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
				@foreach ($ledger->report as $item)
					<tr>
						<td>{{ Str::date($item->txn_date) }}</td>
						<td>{{ $item->description ?? 'N/A' }}</td>
						<td>{{ $item->narration ?? 'N/A' }}</td>
						<td>{{ Str::currency($item->amount_db) }}</td>
						<td>{{ Str::currency($item->amount_cr) }}</td>
						@php
							$total += $item->amount_cr - $item->amount_db;
						@endphp
						{{-- <td>{{ Str::currency($total) }}</td> --}}
					</tr>
				@endforeach
				@if ($ledger->report->count() == 0)
					<tr>
						<td colspan="4">No Transactions</td>
						<td> 0.00</td>
					</tr>
				@endif
				{{--  <tr>
					<td colspan="4" class="text-right">Total Outstanding</td>
					<td>{{ Str::currency($total) }}</td>
				</tr> --}}
			</table>
		@endforeach
	</div>
@endsection
