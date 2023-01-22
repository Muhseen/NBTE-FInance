@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row">
			<h2>Issue Non-Personal Advance</h2>
		</div>
		<hr>
		@include('partials.messages')
		<div class="row  justify-content-end pr-3">

			<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#minutes_modal"
				data-whatever="@mdo">Add New Staff Debtor</button>
			<div class="modal fade" id="minutes_modal" tabindex="-1" aria-labelledby="minutes_modal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Register Staff as debtor</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="modal-body">
								<form method="POST" action="{{ route('staffDebtor.store') }}">
									@csrf
									<div class="mb-3">
										<label for="recipient-name" class="col-form-label">File Number : </label>
										<input type="text" class="form-control" id="recipient-name" name="file_no">
									</div>
									<div class="mb-3">
										<label for="message-text" class="col-form-label">Fullname</label>
										<input class="form-control"name="fullname" id="message-text"></input>
									</div>

							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Add Staff Debtor</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<form action="/npa" method="POST">
			@csrf
			<div class="row">
				<div class="col-lg-4">
					<div class="from-group"><label for="">Staff</label><select name="staff_id" id=""
							class="form-control">
							@foreach ($staff as $s)
								<option value="{{ $s->id }}">{{ $s->fullname }}</option>
							@endforeach
						</select></div>
				</div>
				<div class="col-lg-4">
					<div class="from-group"><label for="">Funding Account</label><select name="funding_account" id=""
							class="form-control">
							<option value="31020103">Overhead</option>
							<option value="31060301">Capital</option>
						</select></div>
				</div>
				<div class="col-lg-4">
					<div class="from-group"><label for="">Transaction Date</label><input type="date" name="txn_date"
							id="" class="form-control"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<div class="form-group"><label for="">Account Code</label><input class="form-control disabled" disabled
							type="text" value="31060301">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group"><label for="">Description</label>
						<input type="text" class="form-control disabled" disabled value="Non Personal Advance">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group"><label for="">Amount</label>
						<input class="form-control" type="number" name="amount" step="0.01">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group"><label for="">Narration</label>
						<textarea name="narration" class="summernote"id="" cols="30" rows="10" "></textarea>

					</div>
				</div>
				<div class="col-lg-4 mt-5">
					<button class=" btn btn-success  mr-3">Save Transaction</button>

				</div>


		</form>
	</div>
@endsection
