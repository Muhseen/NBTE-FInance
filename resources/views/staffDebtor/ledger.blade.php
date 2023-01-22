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
		<div class="text-center">
			<h3> Staff Debtor Ledger for {{ $staff->fullname }}</h3> <br>
			<h5>Generated On {{ now() }}</h5>
		</div>
		<div class="row">
			<table class="table table-striped table-hover table-active table-bordered">
				<tr>
					<th>Date</th>
					<th>Account Code</th>
					<th>Description</th>
					<th>Narration</th>
					<th>Amount Db</th>
					<th>Amount Cr</th>
					<th>Balance</th>
				</tr>
				@php
					$total = 0;
				@endphp
				@foreach ($reports as $r)
					@php
						$total += $r->amount_cr - $r->amount_db;
					@endphp
					<tr>
						<td>{{ $r->txn_date }}</td>
						<td>{{ $r->code }}</td>
						<td>{{ $r->description }}</td>
						<td>{!! $r->narration !!}</td>
						<td>{{ Str::currency($r->amount_cr) }}</td>

						<td>{{ Str::currency($r->amount_db) }}</td>
						<td>{{ Str::currency($total) }}</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="5"></td>
					<td class=" text-left"style="text-align: :right !important;">Total Outstanding</td>
					<td>{{ Str::currency($total) }}</td>
				</tr>
			</table>
		</div>
	</div>
@endsection
