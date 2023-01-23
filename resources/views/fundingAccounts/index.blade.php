@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row card-header">
			<div class="col-9">
				<h2>List of All Funding Accounts</h2>

			</div>
			<div class="col-3">
				<a href="{{ route('fundingAccount.create') }}" class="btn btn-dark">Add New Account</a>
			</div>
		</div>
		<div class="row">
			<table class="table table-striped table-bordered table-active">
				<tr>
					<th>S/N</th>
					<th>Account Code</th>
					<th>Account Name</th>
					<th>Balance</th>
					<th>Edit</th>

				</tr>
				@foreach ($fa as $f)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $f->account_code }}</td>
						<td>{{ $f->name }}</td>
						<td>{{ $f->balance }}</td>
						<td> <a href="{{ route('fundingAccount.edit', $f) }}" class=" btn btn-warning">Edit</a> </td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection
