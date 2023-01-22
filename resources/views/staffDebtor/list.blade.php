@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<div class="row">
			<h2>List Of Staff Debtors</h2>
		</div>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>File No</th>
						<th>Outstanding</th>
						<th>View Ledger</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($staffDebtors as $s)
						<tr>
							<td>{{ $s->fullname }}</td>
							<td>{{ $s->file_no }}</td>
							<td>{{ $s->outstanding }}</td>
							<td>
								<a href="/staffDebtor/{{ $s->id }}" class="btn btn-dark">View Ledger</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4" class="text-center"> No Debtors</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection
