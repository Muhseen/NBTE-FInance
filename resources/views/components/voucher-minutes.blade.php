<div class="modal fade" id="minutes_modal" tabindex="-1" aria-labelledby="minutes_modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route('voucherMinutes.store') }}">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Comment/Minute on Voucher</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					@csrf
					<input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Sent From:</label>
						<input type="text" class="form-control" id="recipient-name" disabled value="{{ Auth::user()->name }}">
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Unit:</label>
						<input type="text" class="form-control" id="recipient-name" disabled value="{{ Auth::user()->unit }}">
					</div>

					<div class="form-group">
						<label for="message-text" class="col-form-label">Message:</label>
						<textarea class="form-control summernote" name="message" id="message-text"></textarea>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save message</button>
				</div>
			</form>
		</div>
	</div>
</div>
