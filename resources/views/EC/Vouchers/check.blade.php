@extends('layouts.main')
@section('content')
	<div class="container-fluid card p-2">
		<h2 class="mx-3 d-print-none"> Check Voucher</h2>
		<hr>
		<x-Voucher-Minutes :voucher="$voucher"></x-Voucher-Minutes>
		@include('partials.messages')
		<div class="row justify-content-end d-print-none">
			<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#minutes_modal"
				data-whatever="@mdo">Add
				Comment/Minute</button>
			<form action="/voucher/{{ $voucher->id }}/edit" method="Get">
				<button class="btn btn-danger  mx-3">Make Corrections</button>
			</form>
			<form action="/reprepare/{{ $voucher->id }}" method="Get">
				<button class="btn btn-warning  mx-3">Return for Reprepartion</button>
			</form>
			<form action="/checkVoucher" method="POSt">
				@csrf
				<input type="hidden" value="{{ $voucher->id }}" name="voucher_id">
				<button class="btn btn-success mr-3">Confirm Check</button>
			</form>
		</div>
		<div class="row mx-2">
			<div class=" col-lg-4 card  d-print-none">
				<div class="row justify-content-center">
					<h3 class="my-3">Approved Payment details</h3>
					<div class="row col-12">
						<div class="card pl-2">
							<ul>
								<li>Payee : {{ $voucher?->payment_approval?->beneficiary ?? 'NA' }}</li>
								<li>Description : {{ $voucher?->payment_approval?->description ?? 'N/A' }}</li>
								<li>Amount : {{ Str::currency($voucher?->payment_approval?->amount ?? 0) }}</li>
								<li>Approval Date : {{ $voucher?->payment_approval?->approval_date ?? 'N/A' }}</li>
								<li>Attachements :
									<ul>
										@foreach (json_decode($voucher?->payment_approval->attachments ?? json_encode([])) as $item)
											<li> <a href="{{ asset('attachments/' . $item) }}" class=" my-2 btn btn-primary">View File</a>
											</li>
										@endforeach
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<h3 class="my-3">Minutes</h3>
					<hr>
					@if ($voucher->minutes->count() == 0)
						<div class="row text-center">
							No Minutes/Comments
						</div>
					@endif
					<div class="row">
						<x-vmtimeline :voucher="$voucher"></x-vmtimeline>
					</div>
				</div>
			</div>
			<div class="col-lg-8 card p-3">
				<h3 class="my-3 text-center">Voucher</h3>
				<hr>
				<x-Voucher :voucher="$voucher" />
			</div>
		</div>
	</div>
@endsection
