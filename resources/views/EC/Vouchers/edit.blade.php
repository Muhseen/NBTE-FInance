@extends('layouts.main')
@section('content')
	<script src="{{ asset('js/banks.js') }}" defer></script>
	<div class="container p-3 card">

		@include('partials.messages')
		<form action="{{ route('voucher.update', $voucher) }}" method="POST">
			@csrf
			@method('PATCH')
			<div class="row">
				<h3 class="col-lg-9 col-sm-12">Prepare Voucher</h3>
				<div class="float-right  justify-content-end col-3">

				</div>
			</div>
			<input type="hidden" name="payment_id" value="{{ $paymentId ?? null }}">
			<hr>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="form-group"><label for="">Payee</label><input name="payee" type="text"
							value="{{ $voucher->payee }}"class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group"><label for="">PV No</label><input type="text"
							value="{{ $voucher->pv_no }}"class="form-control" name="pv_no">
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group"><label for="">Date</label><input type="date" value="{{ $voucher->txn_date }}"
							name="txn_date"class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="form-group"><label for="">Bank</label>
						<select type="text" id="banks" name="bank" value=""class="form-control">
							@foreach ($banks as $bank)
								<option value={{ $bank->id }}" {{ $bank->id == $voucher->id ? 'Selected' : '' }}>{{ $bank->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group"><label for="">Bank Branch</label><input type="text" name="bank_branch"
							class="form-control" value="{{ $voucher->bank_branch }}"></div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="form-group"><label for="">Account No</label><input type="number"
							value="{{ $voucher->account_no }}" name="account_no" maxlength="10" class="form-control"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="form-group"><label for="">Account Code</label>

						<select name="account_code" id="account_code" class="form-control select2">
							<option value="">Select Account Code</option>
							@foreach ($coa as $c)
								<option value="{{ $c->EconSegCode }}" {{ $voucher->account_code == $c->EconSegCode ? 'selected' : '' }}>
									{{ $c->LineItem }} : {{ $c->EconSegCode }}</option>
							@endforeach
						</select>
						<div class="details text-danger text-bold"></div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group"><label for="">Amount</label><input type="number" id="amount"
							step="0.01"name="amount" value="{{ $voucher->amount }}" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<div class="form-group">
						<label for="">Withholding Tax</label>
						<input class="form-control"type="number" name="wht" id="wht" step="0.01"
							value="{{ $voucher->wht }}">
					</div>

				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="">VAT</label>
						<input class="form-control"type="number" name="vat" id="vat" value="{{ $voucher->vat }}"
							step="0.01">
					</div>

				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label for="">Stamp Duty</label>
						<input class="form-control"type="number" name="stamp" id="stamp" step="0.01"
							value="{{ $voucher->stamp_duty }}">
					</div>

				</div>
				@php
					$payable = $voucher->amount - ($voucher->vat + $voucher->wht + $voucher->stamp_duty);
				@endphp
				<div class="col-lg-2">
					<div class="form-group">
						<label for="">Total Payable</label>
						<input class="form-control"type="number" name="payable" id="payable" step="0.01"
							value="{{ $payable }}">
					</div>

				</div>
				<div class="col-lg-4"><label for="">Type</label>
					<select name="type" id="" class="form-control">
						<option value="contract">Contract</option>
						<option value="claim">Claim</option>

					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
						<label for="">Detailed Description</label>
						<textarea class="form-control" name="detailed_description"cols="95" value="">{{ $voucher->detailed_description }}</textarea>
					</div>
				</div>
				<div class="col-lg-4 ">
					<div class="form-group"><label for="">
							To be checked by</label>
						<select name="check_by" id="" class="form-control">
							@foreach ($users as $u)
								<option value="{{ $u->id }}" {{ old('check_by') == $u->id ? 'selected' : '' }}>{{ $u->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="row ml-1">
				<button class="btn btn-success">Update Voucher</button>
			</div>
		</form>
	</div>
	<script>
		$("#account_code").on('change', function() {
			let val = $(this).val();
			$.ajax({
				type: "GET",
				url: "/getCodeBudgetDetails",
				data: {
					code: val
				},
				dataType: "text",
				success: function(response) {
					$(".details").text(response);
				}
			});
		});
		$(document).ready(function() {
			ComputeTax();
		});
		$("#amount").on("keyup", function() {
			ComputeTax();
		});
		$("#type").on('change', function() {
			ComputeTax();
		});

		function ComputeTax() {
			let tax = 0;
			let total_tax = 0;
			let wht = 0;
			let stamp = 0;
			let amount = $("#amount").val()
			if (amount.length == 0) {
				return;
			}
			if (amount <= 0) {
				return
			}
			amount = parseFloat(amount);
			let type = $("#type").val();
			if (type == "Contract") {
				vat = Number((amount / 1.075) * 0.075).toFixed(2);
				wht = Number((amount - vat) * 0.05).toFixed(2);
				stamp = Number((amount - vat) * 0.01).toFixed(2);
				total_tax = parseFloat(vat) + parseFloat(stamp) + parseFloat(wht)
			} else {
				vat = Number((amount / 1.075) * 0.075).toFixed(2);
				wht = Number((amount - vat) * 0.1).toFixed(2);
				stamp = Number((amount - vat) * 0.01).toFixed(2);
				total_tax = parseFloat(vat) + parseFloat(stamp) + parseFloat(wht)
			}
			let payable = Number((amount - total_tax)).toFixed(2);
			console.log({
				amount
			})
			console.log({
				total_tax
			})
			console.log({
				payable
			})
			$("#vat").val(vat);
			$("#wht").val(wht);
			$("#stamp").val(stamp);
			$("#payable").val(payable);

		}
	</script>
@endsection
