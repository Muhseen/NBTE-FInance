@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		@include('partials.messages')
		<h3>Select Report</h3>
		<hr>
		<div class="row p-3 my-3">
			<div class="card-group">
				<div class="col h-100">
					<div class="card h-100">
						<div class="card-body">
							<form action="/ledger">

								<h3 class="card-title text-bold">View Specific Ledger</h3>
								<p class="card-text"> This reprot will provess a ledger of a specific account code</p>
								<hr>
								<div class="form-group"><label for="">Select Account Code</label>
									<select name="account_code" id="" class="form-control select2-blue">
										@foreach ($coa as $c)
											<option value="{{ $c->EconSegCode }}">{{ $c->EconSegCode }}: {{ $c->LineItem }}</option>
										@endforeach
									</select>
								</div>
						</div>
						<div class="card-footer">
							<small class="text-muted">
								<button class="btn btn-success">Process Report</button>
							</small>
						</div>
						</form>
					</div>
				</div>
				<div class="col">
					<div class="card h-100">
						<h4></h4>
						<div class="card-body">
							<form action="/sjv" method="post">
								@csrf
								<h3 class="card-title text-bold">SJV</h3>
								<p class="card-text">This report generates an SJV for a specified Period</p>
								<hr>
								<div class="form-group"><label for="">Select Account Code</label>
									<select name="code" id="" class="form-control select2-blue">
										@foreach ($coa as $c)
											<option value="{{ $c->EconSegCode }}">{{ $c->EconSegCode }}: {{ $c->LineItem }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group"><label for="">Start Date</label><input type="date" name="start_date"
										id="" class="form-control"></div>
								<div class="form-group"><label for="">End Date</label><input type="date" name="end_date"
										id="" class="form-control"></div>
						</div>
						<div class="card-footer">
							<button class="btn btn-success">Process SJV</button>
						</div>
						</form>
					</div>
				</div>
				<div class="col">
					<div class="card h-100">
						<h4></h4>
						<div class="card-body">
							<form action="/generalLedger" method="post">
								@csrf
								<h3 class="card-title text-bold">General Ledger</h3>

								<p class="card-text">This report generates the General Ledger</p>
								<hr>
								<div class="form-group"><label for="">Start Date</label><input type="date" name="start_date"
										id="" class="form-control"></div>
								<div class="form-group"><label for="">End Date</label><input type="date" name="end_date"
										id="" class="form-control"></div>
						</div>
						<div class="card-footer">
							<button class="btn btn-success">Process General Ledger</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<h3>Payment Reports</h3>
		<hr>
		<div class="row p-3 my-3">
			<div class="card-group">
				<div class="col">
					<div class="card px-2 h-100">
						<div class="card-body">
							<form action="/paymentReports" method="POST">
								@csrf
								<h3 class="card-title text-bold">Payments Made in Respect of</h3>
								<p class="card-text"> This generates a report for payments made in respect of an account code</p>
								<hr>
								<input type="hidden" name="type" value="reason">
								<div class="form-group"><label for="">Select Account Code</label>
									<select name="account_code" id="" class="form-control select2-blue select2">
										@foreach ($coa as $c)
											<option value="{{ $c->EconSegCode }}">{{ $c->EconSegCode }}: {{ $c->LineItem }}</option>
										@endforeach
									</select>
								</div>
						</div>
						<div class="card-footer">
							<small class="text-muted">
								<button class="btn btn-success">Process Report</button>
							</small>

						</div>
						</form>
					</div>
				</div>
				<div class="col">
					<div class="card px-2 h-100">
						<h4></h4>
						<div class="card-body">
							<form method="POST" action="/paymentReports">
								@csrf
								<input type="hidden" name="type" value="date_range">
								<h3 class="card-title text-bold">Payments Made Between</h3>
								<p class="card-text">This generates reports for payments made between the specified and end dates</p>
								<hr>
								<div class="form-group"><label for="">Start Date</label><input type="date" name="start_date"
										id="" class="form-control"></div>
								<div class="form-group"><label for="">End Date</label><input type="date" name="end_date"
										id="" class="form-control"></div>
						</div>
						<div class="card-footer">
							<button class="btn btn-success">Generate Report</button>
						</div>
						</form>
					</div>
				</div>
				<div class="col">
					<div class="card h-100  px-2">
						<h4></h4>
						<div class="card-body">
							<form action="/paymentReports" method="POST">
								@csrf
								<h3 class="card-title text-bold">Payments Made in Name of</h3>
								<input type="hidden" name="type" value="name">
								<p class="card-text">This find all payments that contain a Parameter search parameter</p>
								<hr>
								<div class="form-group"><label for="">Name</label><input type="text" name="payee"
										id="" class="form-control"></div>
						</div>
						<div class="card-footer">
							<button class="btn btn-success">Find Payments</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<h3>Income Reports</h3>
		<hr>
		<div class="row p-3 my-3">
			<div class="card-group">
				<div class="col">
					<div class="card px-2 h-100">
						<div class="card-body">
							<form action="/incomeReports">
								<input type="hidden" value="account_code" name="type">
								<h3 class="card-title text-bold">Income received in Respect of</h3>
								<p class="card-text"> This generates a report for income received in respect of an account code</p>
								<hr>
								<div class="form-group"><label for="">Select Account Code</label>
									<select name="account_code" id="" class="form-control select2-blue">
										@foreach ($coa as $c)
											<option value="{{ $c->EconSegCode }}">{{ $c->EconSegCode }}: {{ $c->LineItem }}</option>
										@endforeach
									</select>
								</div>
						</div>
						<div class="card-footer">
							<small class="text-muted">
								<button class="btn btn-success">Process Report</button>
							</small>
						</div>
						</form>
					</div>
				</div>
				<div class="col">
					<div class="card px-2 h-100">
						<form action="/incomeReports">
							<h4></h4>
							<input type="hidden" value="date_range" name="type">

							<div class="card-body">
								<h3 class="card-title text-bold">Income received Between</h3>
								<p class="card-text">This generates reports Income received between the specified and end dates</p>
								<hr>
								<div class="form-group"><label for="">Start Date</label><input type="date" name="start_date"
										id="" class="form-control"></div>
								<div class="form-group"><label for="">End Date</label><input type="date" name="end_date"
										id="" class="form-control"></div>
							</div>
							<div class="card-footer">
								<button class="btn btn-success">Process Report</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col">
					<div class="card px-2 h-100">
						<h4></h4>
						<form action="/incomeReports">
							<div class="card-body">
								<h3 class="card-title text-bold">Income Received in the name of </h3>
								<input type="hidden" value="name" name="type">

								<p class="card-text">This report generates report for income received in a specified Name</p>
								<hr>
								<div class="form-group"><label for="">Payer</label><input type="text" name="name"
										id="" class="form-control"></div>
							</div>
							<div class="card-footer">
								<button class="btn btn-success">Process Report</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
