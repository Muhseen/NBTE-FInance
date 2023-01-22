@extends('layouts.main')
@section('content')
	<div class="container card-p-3">

		<h2>Payment Vouchers Pending Audit</h2>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Payee</th>
					<th>Amount</th>
					<th>Details</th>
					<th>Prepared By</th>
					<th>Checked By</th>
					<th>Approved By</th>
					<th>Preview</th>
				</tr>
				@forelse ($vouchers as $voucher)
					<tr>
						<td>{{ $voucher->payee }}</td>
						<td>{{ Str::currency($voucher->amount) }}</td>
						<td>{{ $voucher->detailed_description }} : {{ $voucher->account_code }}</td>
						<td>{{ $voucher->preparedBy->name }}</td>
						<td>{{ $voucher->checkedBy->name }}</td>
						<td>{{ $voucher->approvedBy->name }}</td>
						<td> <a href="/auditPreview/{{ $voucher->id }}" class="btn btn-success">Preview</a></td>
					</tr>
				@empty
					<tr>
						<td colspan="7" class="text-center"> No Pending Payments</td>
					</tr>
				@endforelse
			</table>
		</div>
	</div>
@endsection
