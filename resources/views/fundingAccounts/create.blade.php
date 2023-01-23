@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row card-header">
			<div class="col-9">
				<h2>Add New Funding Accounts</h2>

			</div>

		</div>
		<form action="{{ route('fundingAccount.store') }}" method="POST">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Account Code</label><input type="text" name="account_code"
							class="form-control"></div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Account Name</label><input type="text" name="name"
							class="form-control"></div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="form-group"><label for="">Current Balance</label><input type="number"
							step="0.01"name="balance" class="form-control"></div>
				</div>
			</div>
			<div class="row my-3">
				<div class="col-lg-2 col-md-6 col-sm-12"><button class="btn btn-success col-12" type="submit">Add Account</button>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-12"><button class="btn btn-warning col-12" type="reset">Clear Entry</button>
				</div>
			</div>
			@csrf
		</form>

	</div>
@endsection
