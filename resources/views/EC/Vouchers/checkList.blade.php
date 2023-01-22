@extends('layouts.main')
@section('content')
	<div class="container-fluid card p-2">
		<h2>Voucher Assigned to {{ Auth::user()->name }} for checking</h2>
		<hr>

		<table class="table-striped table-bordered table">
			<tr>
				<th>PV No</th>
				<th>Prepare On</th>
				<th>Prepared By</th>
				<th>Payee</th>
				<th>Amount</th>
				<th>Check</th>
			</tr>
			@forelse ($vouchers as $v)
				<tr>
					<td>{{ $v->pv_no }}</td>
					<td>{{ $v->prepared_date }}</td>
					<td>{{ $v->preparedBy->name }}</td>
					<td>{{ $v->payee }}</td>
					<td>{{ Str::currency($v->amount) }}</td>
					<td><a href="/checkVoucher/{{ $v->id }}" class="btn btn-success">Check</a></td>
				</tr>
			@empty
				<tr>
					<td colspan="6" class="text-center">No Vouchers to check</td>
				</tr>
			@endforelse
		</table>

	</div>
@endsection
