@extends('layouts.main')
@section('content')
	<style>
		table {
			page-break-after: always;
		}
	</style>
	<div class="container">
		{!! $table !!}
	</div>
@endsection
