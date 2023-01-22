@extends('layouts.app')
@section('content')
	{{-- @inject('formatter', 'App\Services\FormatterServices') --}}
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container card p-3">
		<div class="row m-2 float-right d-print-none">
			<button class="btn btn-success  col-2" onclick="window.print()">Print Report</button>
		</div>
		<div class='card  text-center card-header'>
			<h1>SMK Medical Center</h1>
			<h2>
				Income and Expenditure Report</h2>
			<h4>
				From {{ $startDate }} <br>
				to {{ $endDate }} <br>

			</h4>
			<p>Generated on {{ now()->toDateString() }}</p>
		</div>
		<table class="table table-striped table-bordered text-center">

			<tr>
				<td></td>
				<td></td>
				<td>Note</td>
				<td>#</td>
				<td>#</td>
			</tr>
			<tr>
				<th>Code</th>
				<th>Description</th>
				<th colspan="3">Income</th>
			</tr>
			@php
				$eTotal = 0;
				$iTotal = $nhisPayments + $tshipPayments;
			@endphp
			<tr>
				<td>12020707(1-4)</td>
				<td>Earnings From Medical Services(T-SHIP) </td>
				<td>-----</td>
				<td>{{ Str::currency($tshipPayments) }}</td>

				<td>-----</td>
			</tr>

			<tr>
				<td>12020707(4-...)</td>
				<td>Earnings From Medical Services(NHIS) </td>
				<td>-----</td>
				<td>{{ Str::currency($nhisPayments) }}</td>

				<td>-----</td>
			</tr>
			@foreach ($income as $inc)
				<tr>
					<td>{{ $inc->first()->account_code }}</td>
					<td>{{ $inc->first()->code->description }}</td>
					<td>-----</td>
					<td>{{ Str::currency($inc->sum('amount')) }}</td>

					<td>-----</td>
				</tr>
				@php
					$iTotal += $inc->sum('amount');
				@endphp
			@endforeach
			<tr>
				<td></td>
				<th class="text-right">
					<p class="text-bolder">Total Income</p>
				</th>
				<td>-----</td>
				<td>-----</td>
				<td>{{ Str::currency($iTotal) }}</td>
			</tr>
			@foreach ($exp as $e)
				<tr>
					<td>{{ $e->first()->in_respect_of }}</td>
					<td>{{ $e->first()->reason->description }}</td>
					<td>{{ Str::currency($e->sum('amount')) }}</td>
					<td>-----</td>
					<td>-----</td>
				</tr>
				@php
					$eTotal += $e->sum('amount');
				@endphp
			@endforeach
			<tr>
				<td></td>
				<th>Total Expenditure</th>
				<td></td>
				<td></td>

				<td>{{ Str::currency($eTotal) }}</td>
			</tr>
			<tr>
				<td>43020101</td>
				<td>Net Surplus(Deficit)</td>
				<td></td>
				<td></td>
				<td>{{ Str::currency($iTotal - $eTotal) }}</td>
			</tr>
		</table>
	</div>
@endsection
