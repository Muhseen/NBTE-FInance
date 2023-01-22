@extends('layouts.main')
@section('content')
	<div class="container p-3 card">
		@include('partials.messages')
		<form method="POST" action="/income">
			@csrf
			<h3>Record Income</h3>

			<hr>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group"><label for="">Payer</label>
						<input type="text" name="payer"class="form-control">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="">Txn Date</label>
						<input name="txn_date" type="date" class="form-control">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="">Amount</label>
						<input name="amount" type="number" step="0.01" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group"><label for="">
							Paid Into</label>
						<select name="paid_into" class="select form-control">
							<option value="31020103">Overhead</option>
							<option value="31020101">Capital</option>
							@foreach ($fundingAccounts as $fa)
								<option value="{{ $fa->account_code }}">{{ $fa->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="form-group"><label for="">Reason</label><select name="account_code" type="text"
							class="form-control select2">
							@foreach ($coa as $coa)
								<option value="{{ $coa->EconSegCode }}">{{ $coa->EconSegCode }}:{{ $coa->LineItem }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group"><label for="">Narration</label>
						<textarea name="narration" type="text" class="form-control summernote"></textarea>
					</div>
				</div>
				<div class="col-lg-4 mt-4">
					<button class="btn btn-success">Record Income</button>
				</div>
			</div>
		</form>
	</div>
@endsection
