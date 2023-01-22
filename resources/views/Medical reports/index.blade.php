@extends('layouts.app')
@section('content')
	<div class="container card p-lg-3">
		@include('partials')
		<h2>Select Report</h2>
		<hr>
		<div class="row my-3">
			<div class="col">

				<div class="card h-100">
					<div class="card-body h-100">
						<form action="/incomeReport" method="GET">
							<input type="hidden" name="type" value="dateRange">
							<h5 class="card-title">Income Report</h5>
							<p class="card-text">View all record Income.</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Start Date</label>
									<input type="date" name="start_date" class="form-control">
								</div>
								<div class="form-group">
									<label for="">End Date</label>
									<input type="date" name="end_date" class="form-control">
								</div>
							</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">Process Income Report</button>
					</div>
					</form>
				</div>

			</div>
			<div class="col">
				<div class="card h-100">
					<form action="/expenditureReport" method="POST">
						@csrf
						<input type="hidden" name="type" value="dateRange">
						<div class="card-body">
							<h5 class="card-title">Generate Expediture Report</h5>
							<p class="card-text">Generate Expenditure Report For a specified Period</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Start Date</label>
									<input type="date" name="start_date" class="form-control">
								</div>
								<div class="form-group">
									<label for="">End Date</label>
									<input type="date" name="end_date" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">Process Expednditure Report</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col">

				<div class="card h-100">
					<div class="card-body h-100">
						<form action="/incomeAndExpenditure" method="GET">
							@csrf
							<h5 class="card-title">Statement of Income and Expenditure</h5>
							<p class="card-text">Use this to generate statement of Income and Expenditure</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Start Date</label>
									<input type="date" name="start_date" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">End Date</label>
									<input type="date" name="end_date" id="" class="form-control">
								</div>
							</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">Process Report </button>
					</div>
					</form>
				</div>

			</div>
		</div>
		<div class="row my-3">
			<div class="col col-4">

				<div class="card h-100 ">
					<div class="card-body h-100">
						<form action="/incomeReport" method="GET">
							<input type="hidden" name="type" value="account_code">
							@csrf
							<h5 class="card-title">Generate Income Report for Account Code</h5>
							<p class="card-text">View Income report for a specific account code</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Account Code</label>
									<select name="account_code" id="" class="form-select">
										@foreach ($coas as $c)
											<option value="{{ $c->code }}">{{ $c->code }}: {{ $c->description }}</option>
										@endforeach
									</select>
								</div>

							</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">Process Income Report</button>
					</div>
					</form>
				</div>

			</div>
			<div class="col col-4">
				<div class="card h-100">
					<div class="card-body">
						<form action="/expenditureReport" method="POST">
							@csrf
							<input type="hidden" name="type" value="account_code">
							<h5 class="card-title">Generate Expditure Report For Account Code</h5>
							<p class="card-text">Generate Expenditure Report For a specific Account Code</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Account Code</label>
									<select name="account_code" id="" class="form-select">
										@foreach ($coas as $c)
											<option value="{{ $c->code }}">{{ $c->code }}: {{ $c->description }}</option>
										@endforeach
									</select>
								</div>

							</div>

					</div>
					<div class="card-footer">
						<button class="btn btn-primary">Process Expednditure Report</button>
					</div>
					</form>
				</div>
			</div>
			<div class="col">

				<div class="card h-100">
					<div class="card-body h-100">
						<form action="/specialSJV" method="POST">
							@csrf
							<h5 class="card-title">View Special Specific Ledger</h5>
							<p class="card-text">Use this to process and view a specific Ledger.</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Type</label>
									<select name="code" id="" class="form-select select2">
										<option value="Service Charge"> Service charge</option>
										<option value="Imprest Payments"> Imprest Payments</option>
										<option value="Bank Payments">Bank Payments</option>
										<option value="Bank Income">Bank Income</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">Start Date</label>
									<input type="date" name="start_date" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">End Date</label>
									<input type="date" name="end_date" id="" class="form-control">
								</div>
							</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">Process Special Ledger</button>
					</div>
					</form>
				</div>

			</div>

		</div>

		<div class="row my-3">
			<div class="col">

				<div class="card h-100">
					<div class="card-body h-100">
						<form action="/accountLedger" method="POST">
							@csrf
							<h5 class="card-title">View Specific Ledger</h5>
							<p class="card-text">Use this to process and view a specific Ledger.</p>
							<div class="row py-3">
								<div class="form-group">
									<label for="">Account Code</label>
									<select name="code" id="" class="form-select select2">
										@foreach ($coas as $coa)
											<option value="{{ $coa->code }}">{{ $coa->description . '-' . $coa->code }}</option>
										@endforeach
									</select>
								</div>
							</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">Process Ledger</button>
					</div>
					</form>
				</div>

			</div>
			<div class="col">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">General Ledger</h5>
						<p class="card-text">Process General Ledger</p>
					</div>
					<div class="card-footer">
						<a href="/generalLedger" class="btn btn-primary">Process Report</a>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card h-100">
					<form action="/trialBalance" method="GET">
						<div class="card-body">
							<h5 class="card-title">Trial Balance</h5>
							<p class="card-text">This report genertes trial balance for a specified perido</p>
							<div class="row">
								<div class="form group col-12"><label for="">Start Date</label><input type="date"
										class="form-control" name="start_date">
								</div>
								<div class="form group col-12"><label for="">End Date</label>
									<input type="date" class="form-control" name="end_date">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary">Generate</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
@endsection
