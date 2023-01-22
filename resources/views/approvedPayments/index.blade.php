@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<h2>Approved Payments</h2>
		<hr>
		@include('partials.messages')
		<div class="row">

			<table class="table table-striped table-bordered">
				<tr>
					<th>Approval Date</th>
					<th>Beneficiary</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Voucher Status</th>
					<th>Type</th>
					<th>Assign(ed) To</th>
					<th>Process Assignment</th>
				</tr>
				@foreach ($payments as $payment)
					<tr>
						<td>{{ $payment->approval_date }}</td>
						<td>{{ $payment->beneficiary }}</td>
						<td>{{ $payment->description }}</td>
						<td>{{ Str::currency($payment->amount) }}</td>
						<td>{{ $payment?->voucher ? 'Prepared' : 'Not Prepared' }}</td>
						<td>{{ Str::ucfirst($payment?->type) }}</td>
						<form action="/assignTo" method="POST">
							@csrf
							<input type="hidden" name="payment_id" value="{{ $payment->id }}">
							<td class="col-2">
								@if ($payment->assign_to)
									{{ $payment->assigned_to->name }}
								@else
									<div class="form-group">
										<select name="user_id" id="user_id" class="form-control">
											<option value="">Select Staff</option>
											@foreach ($users as $user)
												<option value="{{ $user->id }}">{{ $user->name }}</option>
											@endforeach
										</select>
									</div>
								@endif
							</td>
							<td>
								<button class="btn btn-success" {{ $payment?->assign_to ? 'disabled' : '' }}>Assign</button>
							</td>
						</form>

					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection
