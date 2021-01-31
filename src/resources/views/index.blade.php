<section class="body h-100 primary-1 secondary-1">
	<div class="container-fluid h-100">
		<div class="row h-100">
			<!-- Left Side -->
			<div id="sidebar-left" class="col-sm-6 col-6 col-md-2 d-none d-md-block position-relative">
				<div class="row top-left nav-bar brand">
					<div class="col align-self-center">
						<a class="navbar-brand me-0 px-2 text-truncate py-2 d-block text-capitalize" href="{{Route::has('home')?route('home'):'/'}}">@yield('siteName',config('app.name'))</a>
					</div>
				</div>
				<div class="row left-panel h-100">
					<div class="col p-2">
						left Panel
					</div>
				</div>
			</div>
			<!-- Right Side -->
			<div class="col position-relative">
				<div class="row top-main nav-bar">
					<div class="col align-self-center">
						<div class="row">
							<div class="col d-flex">
								<div class="navbar-toggler d-md-none collapsed border-0" data-bs-toggle="collapse"
									data-bs-target="#sidebar-left" aria-controls="sidebar-left" aria-expanded="false"
									aria-label="Toggle menu">
									<i class="fas fa-bars fa-lg"></i>
								</div>
								<div class="topbar-controls">
									controls...
								</div>
							</div>
							<div class="col-2">
								user info
							</div>
						</div>
					</div>
				</div>
				<div class="row main h-100">
					<div class="col p-2">
						<main>
							Hazy says: Meow~~~
						</main>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>