<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
                        <img src="{{ asset('./assets/dashboard/img/profile2.jpg') }}" alt="Img Profile">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Hizrian
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="{{ route('admin.dashboard') }}">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
								<span class="badge badge-count">5</span>
							</a>
						</li>
						<li class="nav-item active">
							<a href="{{ route('users.dashboard.index') }}">
								<i class="la la-user"></i>
								<p>Users</p>
								<span class="badge badge-count">5</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="main-panel">