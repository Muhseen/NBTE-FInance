@extends('layouts.main')
@section('content')
	<div class="container p-3">
		<h4>Recent Vouchers</h4>
		<table class="table table-bordered table-striped table-active-table-hover">
			<tr>
				<th>Txn Date</th>
				<th>Payee</th>
				<th>Amount</th>
				<th>Detaild Description</th>
				<th>Prepared By</th>
				<th>Checked By</th>
				<th>Preview</th>
			</tr>
			<tbody>
				@foreach ($vouchers as $v)
					<tr>
						<td>{{ $v->txn_date }}</td>
						<td>{{ $v->payee }}</td>
						<td>{{ Str::currency($v->amount) }}</td>
						<td>{{ $v->detailed_description }}</td>
						<td>{{ $v->preparedBy->name }}</td>
						<td>{{ $v->checked_by }}</td>
						<td> <a href="/voucher/{{ $v->id }}" class="btn btn-success">Preview</a> </td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<hr>
	</div>
@endsection
