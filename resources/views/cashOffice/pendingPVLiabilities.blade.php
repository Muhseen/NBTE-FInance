@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<h3>Pending Liabilities</h3>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Payee</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Status</th>
					<th>Pay</th>
					@foreach ($vouchers as $v)
				<tr>
					<td>{{ $v->payee }}</td>
					<td>{{ Str::currency($v->amount) }}</td>
					<td>{{ $v->detailed_description }}</td>
					<td>{{ 'Unpaid' }}</td>
					<td>
						<form action="/payVoucher/create">
							<input type="hidden" name="voucher_id" value="{{ $v->id }}">
							<button href="/payVoucher/create" class="btn btn-success">Pay</button>

						</form>
					</td>
					<td></td>
				</tr>
				@endforeach
				</tr>

			</table>
		</div>
	</div>
@endsection
