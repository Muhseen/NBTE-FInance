@extends('layouts.main')
@section('content')
	<div class="container p-3 card">
		<div class="row">
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">
			</div>
			<div class="col-10 text-center">
				<h2>National Board for Technical Education</h2>
				<h4>Payment Voucher</h4>
			</div>
			<div class="col-1">
				<img src="{{ asset('images/logo.png') }}" alt="NBTE LOGO" width="60px" height="60px">

			</div>
		</div>
		<div class="row">
			<div class="col-2 text-bold">Payee :</div>
			<div class="col-4 text-left">{{ $voucher->payee }}</div>
			<div class="col-2 text-bold">PV No : </div>
			<div class="col-4 text-left">{{ $voucher->pv_no }}</div>
			<div class="col-2 text-bold">Bank :</div>
			<div class="col-4 text-left">{{ $voucher->bank }}</div>
			<div class="col-2 text-bold">Account Code : </div>
			<div class="col-4 text-left">{{ $voucher->account_code }}</div>
			<div class="col-2 text-bold">Bank Branch :</div>
			<div class="col-4 text-left">{{ $voucher->bank_branch }}</div>
			<div class="col-2 text-bold">Bank A/C No : </div>
			<div class="col-4 text-left">{{ $voucher->account_no }}</div>

		</div>
		<div class="row">
			<table class="table table-bordered py-3">
				<tr>
					<th>Date</th>
					<th>Detailed Description</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td class="col-2">{{ $voucher->txn_date }}</td>
					<td class="col-7">{{ $voucher->detailed_description }}</td>
					<td></td>
					<td class="col-2">{{ $voucher->amount }}</td>
				</tr>
				<tr>
					<td colspan="2"> Total Amount in Words : {{ $voucher->amount }}</td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="row">
			<div class="col-6 text-center">
				Prepared By : <br>
				{{ strToUpper($voucher->preparedBy->name) }} <br>
				Date : {{ $voucher->prepared_date }}
			</div>
			<div class="col-6 text-center">
				Checked By : <br>
				{{ strToUpper($voucher?->checkedBy?->name ?? 'N/A') }} <br>
				Date : {{ $voucher->cheCked_date }}
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered">
				<tr>
					<td class="col-5 py-5 text-center">
						<p>
							<strong> Certificate</strong><br>
							I certify that the above amount is correct and <br>
							was incurred under the relevant contract. Financial authority
							or other regulations quoted: that services have been duly performed and that the rate/price charged is according
							to regulations contract fair and res
						</p>
					</td>
					<td>
						<p style="rotateX(-90)" class="text-center">Officer Authorizing Payment</p>
					</td>
					<td class="col-5 py-5 text-center">
						Name : <br>
						{{ strToUpper($voucher?->approvedBy?->name ?? 'N/A') }} <br>
						Date : {{ $voucher->approved_date }}
					</td>
				</tr>
			</table>
		</div>
	</div>
@endsection
