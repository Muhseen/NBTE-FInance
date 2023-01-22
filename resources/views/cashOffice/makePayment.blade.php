@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<h3>Process a Payment</h3>

		<hr>
		@include('partials.messages')
		<button type="button" class="btn btn-primary col-2" data-toggle="modal" data-target="#exampleModal"
			data-whatever="@mdo">Preview Voucher</button>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content ">

					<x-voucher :voucher="$voucher"></x-voucher>
				</div>
			</div>
		</div>
		<form action="{{ route('payVoucher.store') }}" method="POSt">
			@csrf
			<input type="hidden" name="account_code" value="{{ $voucher->account_code }}">
			<input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group">
						<label for="">Payment date</label>
						<input type="date" name="txn_date"class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Batch No</label>
						<input type="text" name="batch_no" class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">PV No</label><input name="pv_no"
							value="{{ $voucher?->pv_no ?? '' }}"type="text" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Payee</label><input name="pv_no"
							value="{{ $voucher?->payee ?? '' }}"type="text" class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for=""> Bank: </label>
						<input name="pv_no" value="" type="text" class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Account No</label><input name="pv_no"
							value="{{ $voucher?->account_no ?? '' }}"type="text" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Payment Type</label>
						<select name="type" value="{{ $voucher?->payment_approval?->type ?? '' }}"type="text" class="form-control">
							<option value="consultancy">Consultancy</option>
							<option value="claim">Claim</option>
							<option value="contract">Contract</option>
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for=""> Amount</label>
						<input
							value="{{ ($voucher?->amount ?? 0) - ($voucher->vat ?? 0) - ($voucher?->wht ?? 0) - ($voucher?->stamp_duty ?? 0) }}"
							name="amount" type="number" step="0.01" class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Funding Account</label>
						<select class="form-control" name="funding_account">
							<option value="31020103">Overhead</option>
							<option value="31020101">Capital</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Account Code</label><input name="pv_no"
							value="{{ ($voucher?->account_code ?? '') . '-' . ($voucher?->description ?? 0) }}"type="text"
							class="form-control">
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="form-group"><label for=""> Description: </label>
						<input name="description" value="{{ $voucher?->detailed_description ?? '' }}" type="text"
							class="form-control">
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-lg-8 col-sm-12">
					<div class="form-group"><label for="">Narration</label>
						<textarea name="narration" id="" cols="60" rows="10" class="summernote col-12"></textarea>
					</div>
				</div>
				<div class="col-lg-4 col-sm-12 ">
					<button class=" btn btn-success mt-5">Process Payment</button>
				</div>
			</div>
	</div>
	</form>
@endsection
