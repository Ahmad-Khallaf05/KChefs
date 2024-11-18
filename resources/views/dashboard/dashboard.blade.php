@extends('layouts.dashboard')

@section('content')
<div class="content">
	<div class="container-fluid">
		<h4 class="page-title">Dashboard</h4>
		<div class="row">
			<!-- Users Card -->
			<div class="col-md-3">
				<div class="card card-stats card-warning">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-users"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Users</p>
									<h4 class="card-title">{{ $usersCount }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Admins Card -->
			<div class="col-md-3">
				<div class="card card-stats card-success">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-bar-chart"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Admins</p>
									<h4 class="card-title">{{ $adminsCount }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Chefs Card -->
			<div class="col-md-3">
				<div class="card card-stats card-danger">
					<div class="card-body">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-newspaper-o"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Chefs</p>
									<h4 class="card-title">{{ $chefsCount }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Dishes Card -->
			<div class="col-md-3">
				<div class="card card-stats card-primary">
					<div class="card-body ">
						<div class="row">
							<div class="col-5">
								<div class="icon-big text-center">
									<i class="la la-check-circle"></i>
								</div>
							</div>
							<div class="col-7 d-flex align-items-center">
								<div class="numbers">
									<p class="card-category">Dishes</p>
									<h4 class="card-title">{{ $dishesCount }}</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- About KChefs Section -->
		<div class="row mt-5">
			<div class="col-md-12">
				<div class="card ">
					<div class="card-body">
						<h5 class="card-title">About KChefs</h5>
						<p class="card-text">
							KChefs is an online platform that connects chefs, admins, and users in one place.
							Admins have the ability to manage users, assign chefs, and oversee the dishes uploaded
							by the chefs. As an admin, you can perform the following tasks:
						</p>
						<ul>
							<li>Manage and view users, including regular users and chefs.</li>
							<li>Add, update, or delete chefs from the platform.</li>
							<li>Monitor and manage the dishes created by chefs.</li>
							<li>View and generate statistics about the platform's usage.</li>
						</ul>
						<p class="card-text">
							The admin dashboard is designed to help you efficiently manage all aspects of KChefs, ensuring smooth operations for chefs and users alike.
						</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection
