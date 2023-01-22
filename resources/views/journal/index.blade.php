@extends('layouts.main')
@section('content')
	<div class="container">

		@include('partials.messages')
		<script src="{{ asset('/js/journal.js') }}" defer type="text/javascript"></script>
		<div class="card card-header">
			<form action="/journal" id="myForm" method="POST">
				@csrf
				<div class="row">
					<div class="col-lg-6 card p-3">
						<h4>Code To Debit</h4>
						<div class="form-group ">
							<label for="">Account Code</label>
							<select name="" id="txtDebitCode" class="form-control select2">
								@foreach ($coas as $coa)
									<option value="{{ $coa->EconSegCode }}">{{ $coa->EconSegCode }}: {{ $coa->LineItem }}</option>
								@endforeach
							</select>

						</div>

						<div class="form-group ">
							<label for="">Amount Dr</label>
							<input id="txtDebitAmount" id="debitAmount" class="form-control" type="number" min="0">
						</div>
						<div class="col-4 mt-4">
							<button id="debitButton" type="button" class="btn btn-sm btn-primary" onclick="addDebit()">Add Debit</button>
						</div>
					</div>
					<div class="col-lg-6 card p-3">
						<h4>Code To Credit</h4>
						<div class="form-group">
							<label for="">Account Code</label>
							<select name="" id="txtCreditCode" class="form-control select2">
								@foreach ($coas as $coa)
									<option value="{{ $coa->EconSegCode }}">{{ $coa->EconSegCode }} : {{ $coa->LineItem }}</option>
								@endforeach
							</select>

						</div>
						<div class="form-group ">
							<label for="">Amount Cr</label>
							<input id="txtCreditAmount" class="form-control" type="number" min="0">
						</div>
						<div class="col-4 mt-4">
							<button id="creditButton" type="button" class="btn btn-sm btn-primary" onclick="addCredit()">Add Credit</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group  col-3">
						<label for="">SJV Number</label>
						<input required name="sjvNo" type="text" required class="form-control">
					</div>
					<div class="form-group col-3"><label for="">Year</label>
						<input type="date" required name="date" required class="form-control">
					</div>
					<div class="form-group col-6">
						<label for="">Narration</label>
						<input type="text"name="narration" required class="form-control">
					</div>
					<div class="col-1 mt-4">
						<button type="button" id="save" class="btn btn-success">Save</button>
					</div>
				</div>
				<div class="row justify-content-center">
					<h2>Post Journal entries</h2>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<table id="debitTable" class="table table-striped ">
							<caption>Total Dr Amount : 0.00 </caption>

							<tbody>
								<tr>
									<td>Code</td>
									<td>Account Name</td>
									<td>Amount</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<table id="creditTable" class="table table-striped">
							<caption>Total Cr Amount : 0.00</caption>
							<tbody>
								<tr>
									<td>Code</td>
									<td>Description</td>
									<td>Amount</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
		</div>
		</form>
	</div>
@endsection
