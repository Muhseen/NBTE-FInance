<div class="timeline timeline-inverse">

	@foreach ($voucher->minutes as $minute)
		<div>
			<i class="fas fa-comments {{ $minute->unit == 2 ? 'bg-danger' : 'bg-primary' }}"></i>

			<div class="timeline-item">
				<span class="time"><i class="far fa-clock"></i> {{ $minute->created_at->diffForHumans() }}</span>

				<h3 class="timeline-header"><a href="#"
						class="{{ $minute->unit == 2 ? 'text-danger' : '' }}">{{ $minute->user->name }}
						:{{ $minute->user->unit }}</a>
					commented on voucher</h3>

				<div class="timeline-body">
					{!! $minute->message !!}
				</div>
				@if (count(json_decode($minute->attachment ?? json_encode([]))) > 0)
					<div class="timeline-footer">
						@foreach ($minute->attachment as $a)
						@endforeach <a href="{{ $a }}" class="btn btn-warning btn-flat btn-sm">View
							Attachment</a>
					</div>
				@endif
			</div>
		</div>
	@endforeach

	<!-- timeline item -->
	<!-- END timeline item -->
	<!-- timeline time label -->

	<!-- /.timeline-label -->
	<!-- timeline item -->

	<!-- END timeline item -->
	@if ($voucher->minutes->count() > 0)
		<div>
			<i class="far fa-clock bg-gray"></i>
		</div>
	@endif
</div>
