@extends('layouts.main')
@section('content')
	<div class="container card p-3">
		@include('partials.messages')
		<form action="/retireNPA" method="POST">
			@csrf <div class="row">
				<h2>Retire Non-Personnal Advance</h2>
			</div>
			<hr>
			<div class="row">
				<input type="hidden" name="npa_id" id="npa_id" value="">
				<div class="col-lg-4">
					<div class="form-group"><label for="">Staff Details</label>
						<select type="text" class="form-control" id="file_no" name="staff_id">
							<option value="">Select Staff</option>
							@foreach ($staff as $s)
								<option value="{{ $s->id }}">{{ $s->fullname }} : {{ $s->file_no }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group"><label for="">Advances given with Dates</label>
						<select type="text" class="form-control" id="npas" name="npa">
						</select>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group"><label for="">Narration</label><input type="text" id="npa_narration"
							class="form-control"></div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group"><label for="">Retirement in respect of </label>
						<select name="account_code" id="account_code" class="form-control select2">
							@foreach ($coas as $c)
								<option value="{{ $c->EconSegCode }}">{{ $c->EconSegCode }} : {{ $c->LineItem }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group"><label for="">Amount</label><input type="text" id="amount" name="amount"
							class="form-control"></div>
				</div>
				<div class="col-lg-3">
					<div class="form-group"><label for="">Amount</label><input type="date" id="rt_date" name="rt_date"
							class="form-control"></div>
				</div>
			</div>
			<div class="row justify-content-end pt-3">
				<div class="col-6">
					<h4 id="outstanding">Outstanding : 0</h4>
				</div>
				<button type="button" class="btn btn-dark col-2" onclick="addItem()">Add Item</button>
			</div>
			<div id="deets" class="row d-none">
				<div class="col-lg-6">
					<h4 class="text-center">Previous Retirements for this NPA</h4>
					<table class="table table-striped table-bordered" id="old_retirements">
						<thead>
							<th>Date</th>
							<th>Description</th>
							<th>Amount</th>
						</thead>
						<tbody id="existing_retirements">

						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<h4 class="text-center">New Retirements for this NPA</h4>
					<table class="table table-striped table-bordered" id="new_retirements">
						<thead>
							<th>Date</th>
							<th>Description</th>
							<th>Amount</th>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>


			</div>
			<div class="row col-2">
				<button type="submit" class="btn btn-success ">Process</button>

			</div>
		</form>

	</div>
	<script>
		var npas = null;
		var total = 0;
		var outstanding = 0

		function addItem() {
			console.log({
				outstanding
			})
			let date = $("#rt_date").val();
			let code = $("#account_code").val();
			let amount = $("#amount").val();
			console.log({
				amount
			})
			console.log(date)
			if (date == "") {
				alert('Please specify date');
				return;
			}
			if (amount <= 0) {
				alert("Amount cannot be 0");
				return;
			}
			if (code == "") {
				alert("Please Select account Code");
				return;
			}
			if (amount > outstanding) {
				alert("Amount is higher than the outstanding for this NPA")
				return;
			}
			$("#new_retirements tbody").append('<tr><td>' + date + '</td><td>' + code + '</td><td>' + amount +
				'</td><input type="hidden" name="items[]"value="' + code + "*" + amount + '*' + date + '"></tr>')
			outstanding -= amount;
			setOutstanding();
			$("#deets").removeClass('d-none');
		}
		$(document).ready(function() {

			$("#file_no").on("change", function() {
				clear();
				$("#npas").empty();
				$("#npa_narration").val("");
				let id = $("#file_no").val();
				$.ajax({
					type: "GET",
					url: "/userNPA",
					data: {
						staff_id: id
					},
					dataType: "JSON",
					success: function(response) {
						if (response.length > 0) {
							npas = response
							$("#npas").empty();
							if (npas.length > 1) {
								$("#npas").append("<option>Select NPA issued</option>")
							}
							for (i = 0; i < response.length; i++) {
								$("#npas").append("<option value='" + response[i].id + "'>" +
									response[i].amount +
									" : " + response[i].txn_date + "</option>")
							}
							if (npas.length == 1) {
								$("#npa_narration").val(npas[0].narration.replace(
									/<\/?[^>]+(>|$)/g, ""));
								processOldRetirements(npas[0]);
								$("#npa_id").val(npas[0].id)
							}

						}

					}
				});
			});
			$("#npas").on("change", function() {
				clear()
				let npa_id = $(this).val();
				$("#npa_id").val(npa_id);
				console.log(npas)
				if (npas != null) {
					for (i = 0; i < npas.length; i++) {
						if (npas[i].id == npa_id) {
							$("#npa_narration").val(npas[i].narration.replace(/<\/?[^>]+(>|$)/g, ""));
							processOldRetirements(npas[i])
							break;
						}

					}

				}
			});
		});

		function setOutstanding() {
			$("#outstanding").text('Outstanding : ' + outstanding);
			console.log("here in")
		}

		function clear() {
			$('#old_retirements tbody').empty();
			$("#npa_narration").val("");
			$("amount").val("")
			$("#deets").addClass("d-none");
			outstanding = 0;
			$("#outstanding").text("Outstanding : " + outstanding);
		}

		function processOldRetirements(npa) {

			outstanding = npa.amount;
			console.log(outstanding)
			console.log(npa.retirements.length)
			if (npa.retirements.length > 0) {
				for (i = 0; i < npa.retirements.length; i++) {

					let r = npa.retirements[i]
					outstanding -= parseFloat(r.amount);
					$('#old_retirements tbody').append('<tr><td>' + r.rt_date +
						'</td> <td>' + r.account_code + '</td><td>' + r
						.amount +
						'</td></tr>')
					total += parseFloat(npa.retirements[i].amount);
				}
				$('#old_retirements tbody').append(
					'<tr><td colspan="2" class="text-right">Total</td><td>' + total + '</td></tr>');
				$("#deets").removeClass("d-none")

			}
			setOutstanding();
		}
	</script>
@endsection
