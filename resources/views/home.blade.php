@extends('layouts.main')

@section('content')
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{ $paymentCount }}</h3>

							<p>Payments this month</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3>{{ $performance ?? rand(50, 60) }}<sup style="font-size: 20px">%</sup></h3>

							<p>Budget Performance</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>{{ $staffCount ?? rand(10, 20) }}</h3>

							<p>Staff</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>{{ Str::currency($committment) }}</h3>

							<p>Total Commitments</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<section class="col-lg-7 connectedSortable">
					<!-- Custom tabs (Charts with tabs)-->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">
								<i class="fas fa-chart-pie mr-1"></i>
								Expenditure Chart
							</h3>
							<div class="card-tools">
								<ul class="nav nav-pills ml-auto">
									<li class="nav-item">
										<a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
									</li>
								</ul>
							</div>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content p-0">
								<!-- Morris chart - Sales -->
								<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
									<canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
								</div>
								<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
									<canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
								</div>
							</div>
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->

					<!-- DIRECT CHAT -->

					<!--/.direct-chat -->

					<!-- TO DO List -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">
								<i class="ion ion-clipboard mr-1"></i>
								Most Recent Pending Payments
							</h3>


						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<ul class="todo-list" data-widget="todo-list">
								@foreach ($pending as $p)
									<li>
										<!-- drag handle -->
										<span class="handle">
											{{ $loop->iteration }}
											<i class="fas fa-ellipsis-v"></i>

										</span>
										<!-- checkbox -->
										<div class="icheck-primary d-inline ml-2">
										</div>
										<!-- todo text -->
										<span class="text"> {{ Str::currency($p->amount) }} being payment to {{ $p->payee }} for
											{{ $p->detailed_description }}</span>
										<!-- Emphasis label -->
										<small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
										<!-- General tools such as edit or delete-->
										<div class="tools">
											<i class="fas fa-edit"></i>
											<i class="fas fa-trash-o"></i>
										</div>
									</li>
								@endforeach

							</ul>
						</div>
						<!-- /.card-body -->
						<div class="card-footer clearfix">
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.Left col -->
				<!-- right col (We are only adding the ID to make the widgets sortable)-->
				<section class="col-lg-5 connectedSortable">

					<div class="card bg-gradient-info">
						<div class="card-header border-0">
							<h3 class="card-title">
								<i class="fas fa-th mr-1"></i>
								Budget Analysis
							</h3>

							<div class="card-tools">
								<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<canvas class="chart" id="line-chart"
								style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
						<!-- /.card-body -->
						<div class="card-footer bg-transparent">
							<div class="row">
								<div class="col-4 text-center">
									<input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
										data-fgColor="#39CCCC">

									<div class="text-white">Approved</div>
								</div>
								<!-- ./col -->
								<div class="col-4 text-center">
									<input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
										data-fgColor="#39CCCC">

									<div class="text-white">Actual</div>
								</div>
								<!-- ./col -->
								<div class="col-4 text-center">
									<input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
										data-fgColor="#39CCCC">

									<div class="text-white">Committed</div>
								</div>
								<!-- ./col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.card-footer -->
					</div>
					<!-- Map card -->
					<div class="card bg-gradient-primary">
						<div class="card-header border-0">
							<h3 class="card-title">
								<i class="fas fa-map-marker-alt mr-1"></i>
								Visitors
							</h3>
							<!-- card tools -->
							<div class="card-tools">
								<button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
									<i class="far fa-calendar-alt"></i>
								</button>
								<button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
							<!-- /.card-tools -->
						</div>
						<div class="card-body">
							<div id="world-map" style="height: 250px; width: 100%;"></div>
						</div>
						<!-- /.card-body-->
						<div class="card-footer bg-transparent">
							<div class="row">
								<div class="col-4 text-center">
									<div id="sparkline-1"></div>
									<div class="text-white">Visitors</div>
								</div>
								<!-- ./col -->
								<div class="col-4 text-center">
									<div id="sparkline-2"></div>
									<div class="text-white">Online</div>
								</div>
								<!-- ./col -->
								<div class="col-4 text-center">
									<div id="sparkline-3"></div>
									<div class="text-white">Sales</div>
								</div>
								<!-- ./col -->
							</div>
							<!-- /.row -->
						</div>
					</div>
					<!-- /.card -->

					<!-- solid sales graph -->

					<!-- /.card -->

					<!-- Calendar -->
					{{--  <div class="card bg-gradient-success">
						<div class="card-header border-0">

							<h3 class="card-title">
								<i class="far fa-calendar-alt"></i>
								Calendar
							</h3>
							<!-- tools card -->
							<div class="card-tools">
								<!-- button with a dropdown -->
								<div class="btn-group">
									<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
										data-offset="-52">
										<i class="fas fa-bars"></i>
									</button>
									<div class="dropdown-menu" role="menu">
										<a href="#" class="dropdown-item">Add new event</a>
										<a href="#" class="dropdown-item">Clear events</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item">View calendar</a>
									</div>
								</div>
								<button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
							<!-- /. tools -->
						</div>
						<!-- /.card-header -->
						<div class="card-body pt-0">
							<!--The calendar -->
							<div id="calendar" style="width: 100%"></div>
						</div>
						<!-- /.card-body -->
					</div>
                    --}}
					<!-- /.card -->
				</section>
				<!-- right col -->
			</div>
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- jQuery UI 1.11.4 -->
	<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="plugins/moment/moment.min.js"></script>
	<script src="plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="dist/js/pages/dashboard.js"></script>
@endsection
