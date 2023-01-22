@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		@include('partials.messages')
		<h2>Approve Checked Vouchers and Send To Audit</h2>
		<hr>

		<div class="row">
			<table class="table table-striped table-bordered table-hover table-active">
				<tr>
					<th>Payee</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Prepared By/Date</th>
					<th>Checked By/Date</th>
					<th>Preview</th>
				</tr>
				@forelse ($vouchers as $v)
					<tr>
						<td>{{ $v->payee }}</td>
						<td>{{ $v->description }}</td>
						<td>{{ Str::currency($v->amount) }}</td>
						<td>{{ $v->preparedBy->name . ': on -' . $v->prepared_date }}</td>
						<td>{{ $v->checkedBy->name . ': on -' . $v->checked_date }}</td>
						<td> <a href="/approveVoucherPreview/{{ $v->id }}" class="btn btn-success">Preview</a></td>

					</tr>
				@empty
					<tr>
						<td colspan="6" class="text-center">No Vouchers Eligible for approval</td>
					</tr>
				@endforelse
			</table>
		</div>
	</div>
@endsection
