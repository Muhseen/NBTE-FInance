@extends('layouts.main')
@section('content')
	<script src="{{ asset('js/jquery-knob.js') }}"></script>
	<script src="{{ asset('js/sparkline.js') }}"></script>
	<div class="conatiner card p-3">
		<h3>Edit Budget Details for :</h3>
		<h4>

			Account Code : {{ $budget->account_code }} <br>
			Account Description : {{ $budget->code->LineItem }}</h4>

		<hr>
		@include('partials.messages')
		<form action="{{ route('budget.update', $budget) }}" method="POST">
			@csrf
			@method('PATCH')
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">
								<i class="far fa-chart-bar"></i> Budget Performance Indicators
							</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="row">
								<div class="col-6 col-md-2 offset-1 text-center">

									<input type="text" class="knob" value="{{ Str::percentage($budget->projection, $budget->projection) }}"
										data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

									<div class="knob-label">Projection : {{ Str::currency($budget->projection) }}</div>
								</div>
								<div class="col-6 col-md-2 text-center">
									<input type="text" class="knob" value="{{ Str::percentage($budget->approved, $budget->projection) }}"
										data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

									<div class="knob-label">Approved : {{ Str::currency($budget->approved) }}</div>
								</div>
								<div class="col-6 col-md-2 text-center">
									<input type="text" class="knob" value="{{ Str::percentage($budget->released, $budget->approved) }}"
										data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

									<div class="knob-label">Released : {{ Str::currency($budget->released) }}</div>
								</div>
								<div class="col-6 col-md-2 text-center">
									<input type="text" class="knob" value="{{ Str::percentage($budget->actual, $budget->approved) }}"
										data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

									<div class="knob-label">Paid/Used : {{ Str::currency($budget->actual) }}</div>
								</div>
								<div class="col-6 col-md-2 text-center">
									<input type="text" class="knob" value="{{ Str::percentage($budget->committed, $budget->approved) }}"
										data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

									<div class="knob-label">Committed : {{ Str::currency($budget->committed) }}</div>
								</div>

								<!-- ./col -->

								<!-- ./col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 form-group">
					<label for="">Account Code</label><input type="text" class="form-control" name=""
						value="{{ $budget->account_code }}" disabled>
				</div>
				<div class="col-lg-8 col-md-6 col-sm-12 form-group"><label for="">Description</label>
					<input type="text" class="form-control" disabled value="{{ $budget->code->LineItem }}">
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 form-group">
					<label for="">Projection</label><input type="number" step="0.01" name="projection" class="form-control"
						value="{{ $budget->projection }}">
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 form-group">
					<label for="">Approved</label><input type="number" step="0.01" name="approved"
						value="{{ $budget->approved }}" class="form-control">
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 form-group">
					<label for="">Paid/Used</label><input type="number" step="0.01" name="actual" class="form-control"
						value="{{ $budget->actual }}">
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 form-group">
					<label for="">Released</label><input type="number" step="0.01" name="released" class="form-control"
						value="{{ $budget->released }}">
				</div>

			</div>
			<div class="row">
				<button class="btn btn-success"> Update Allocation Details</button>
			</div>
		</form>
	</div>
	<script>
		$(function() {
			/* jQueryKnob */

			$('.knob').knob({
				/*change : function (value) {
				//console.log("change : " + value);
				},
				release : function (value) {
				console.log("release : " + value);
				},
				cancel : function () {
				console.log("cancel : " + this.value);
				},*/
				draw: function() {

					// "tron" case
					if (this.$.data('skin') == 'tron') {

						var a = this.angle(this.cv) // Angle
							,
							sa = this.startAngle // Previous start angle
							,
							sat = this.startAngle // Start angle
							,
							ea // Previous end angle
							,
							eat = sat + a // End angle
							,
							r = true

						this.g.lineWidth = this.lineWidth

						this.o.cursor &&
							(sat = eat - 0.3) &&
							(eat = eat + 0.3)

						if (this.o.displayPrevious) {
							ea = this.startAngle + this.angle(this.value)
							this.o.cursor &&
								(sa = ea - 0.3) &&
								(ea = ea + 0.3)
							this.g.beginPath()
							this.g.strokeStyle = this.previousColor
							this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
							this.g.stroke()
						}

						this.g.beginPath()
						this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
						this.g.stroke()

						this.g.lineWidth = 2
						this.g.beginPath()
						this.g.strokeStyle = this.o.fgColor
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth *
							2 / 3, 0, 2 * Math.PI, false)
						this.g.stroke()

						return false
					}
				}
			})
			/* END JQUERY KNOB */

			//INITIALIZE SPARKLINE CHARTS
			var sparkline1 = new Sparkline($('#sparkline-1')[0], {
				width: 240,
				height: 70,
				lineColor: '#92c1dc',
				endColor: '#92c1dc'
			})
			var sparkline2 = new Sparkline($('#sparkline-2')[0], {
				width: 240,
				height: 70,
				lineColor: '#f56954',
				endColor: '#f56954'
			})
			var sparkline3 = new Sparkline($('#sparkline-3')[0], {
				width: 240,
				height: 70,
				lineColor: '#3af221',
				endColor: '#3af221'
			})

			sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
			sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
			sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

		})
	</script>
@endsection
