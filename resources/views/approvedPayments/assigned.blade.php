@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<h2>Payments assigned to {{ Auth::user()->name }} for Voucher preparation</h2>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Approval Date</th>
					<th>Beneficiary</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Prepare Voucher</th>
				</tr>
				@forelse ($payments as $payment)
					<tr>
						<td>{{ $payment->approval_date }}</td>
						<td>{{ $payment->beneficiary }}</td>
						<td>{{ $payment->description }}</td>
						<td>{{ Str::currency($payment->amount) }}</td>
						<td>
							<form action="{{ route('voucher.create') }}" method="GET">
								<input type="hidden" name="payment_id" value="{{ $payment->id }}">
								<input type="hidden" name="amount" value="{{ $payment->amount }}">
								<input type="hidden" name="beneficiary" value="{{ $payment->beneficiary }}">
								<input type="hidden" name="description" value="{{ $payment->description }}">
								<button class="btn btn-success">Prepare Voucher</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="7" class="text-center"> No Payments assigned to you</td>
					</tr>
				@endforelse

			</table>
		</div>
	</div>
@endsection
