<aside class="main-sidebar sidebar-dark-primary elevation-4">

	<a href="index3.html" class="brand-link">
		<img src="{{ asset('images/cash.jpg') }}" alt="Logo" width="40"
			height="60"class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">{{ session('module') ?? 'Finance Module' }}</span>
	</a>

	<div class="sidebar">

		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{ asset('images/user.png') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">{{ Auth::user()->name ?? 'N/A' }}</a>
			</div>
		</div>

		<nav class="mt-2 nav-flat">

			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<li class="nav-item">
					<a href="/home" class="nav-link ">
						<i class="nav-icon fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>

				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-file-word"></i>
						<p>Exepnditure Control<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('payments.index') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Approved Payments</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('payments.assigned') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Assigned Payments</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('voucher.create') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Prepare Voucher</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('checkVoucher.index') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Review/Check
									Vouchers</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/approveVouchers" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Approve Voucher</p>
							</a>
						</li>

					</ul>
				</li>

				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-building"></i>
						<p>Loans And Advances<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/npa" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Issue Non-Personal Advance </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/retireNPA" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Retire Non-Personal Advance </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/staffDebtor" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Staff Debtors' List </p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-table"></i>
						<p>Cash Office<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/pendingPVLiabilities" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Cleared Unpaid PVs</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/coReports" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Generate Reports</p>
							</a>
						</li>

					</ul>
				</li>
				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-file-word"></i>
						<p>Audit<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/viewAuditableVouchers" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Review Payment Vouchers</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/viewAuditableNPA" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Review NPAs/Loans</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-file-word"></i>
						<p>Budget<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="/" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('budget.index') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Budget Details</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item ">
					<a href="/journal" class="nav-link ">
						<i class="nav-icon fas fa-file-word"></i>
						<p>Journal<i class="right fas fa-angle-lef"></i></p>
					</a>
				</li>
				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-file-word"></i>
						<p>Reports<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('voucher.create') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>General Ledger</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('trialbalance') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Trial Balance</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Cash Book</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item ">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-file-word"></i>
						<p>Admin<i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('voucher.create') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Account Codes</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('banks.index') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Banks</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('fundingAccount.index') }}" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Funding Accounts</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/journalEntries" class="nav-link ">
								<i class="far fa-circle nav-icon"></i>
								<p>Journal Entries</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>

	</div>

</aside>
