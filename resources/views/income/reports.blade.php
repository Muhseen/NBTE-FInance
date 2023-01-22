@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row">
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">
			</div>
			<div class="col-10 text-center">
				<h2>National Board for Technical Education</h2>
			</div>
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">

			</div>
		</div>
		<h3 class="text-center">
			Income Report
		</h3>
		<h5 class="text-center">{{ $headers }}</h5>
		<h5 class="text-center">{{ 'Generated On ' . now() }}</h5>

		<div class="row">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Date</th>
					<th>Paid in By</th>
					<th>Paid in Respect of </th>
					<th>Narration</th>
					<th>Paid Into</th>
					<th>Amount</th>
				</tr>
				@foreach ($income as $i)
					<tr>
						<td>{{ $i->txn_date }}</td>
						<td>{{ $i->payer }}</td>
						<td>{{ $i->coa->EconSegCode . ':' . $i->coa->LineItem }}</td>
						<td>{!! $i->narration ?? 'N/A' !!} </td>
						<td>{{ $i->paid_into }}</td>
						<td>{{ Str::currency($i->amount) }}</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="5" class="text-right text-bold">Total</td>
					<td class="text-bold">{{ Str::currency($i->sum('amount')) }}</td>
				</tr>
			</table>
		</div>
	</div>
@endsection
