@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		<h1>Budget Allocations for year {{ $year }}</h1>
		<hr>
		<div class="row">
			<table class="table table-striped table-bordered active hover table-head-fixed text-nowrap" style="height: 500px;">
				<tr>
					<th>Account Code</th>
					<th>Description</th>
					<th class="text-center">Projections</th>
					<th class="text-center">Approved</th>
					<th class="text-center">Actual</th>
					<th class="text-center">Performance</th>
					<th>Edit</th>
				</tr>
				@foreach ($budgets as $budget)
					<tr>
						<td>{{ $budget->account_code }}</td>
						<td>{{ $budget->code->LineItem }}</td>
						<td>{{ Str::currency($budget->projection) }}</td>
						<td>{{ Str::currency($budget->approved) }}</td>
						<td>{{ Str::currency($budget->actual) }}</td>
						<td>{{ Str::percentage($budget->actual, $budget->approved) }}</td>
						<td> <a href="{{ route('budget.edit', $budget) }}" class="btn btn-success">Edit</a></td>
					</tr>
				@endforeach
				<tr>
					<td colspan="6">{{ $budgets->links() }}</td>
				</tr>
			</table>
		</div>
	</div>
@endsection
