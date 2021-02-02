@includeIf('fe_theme::topbar')
<section class="body h-100 brand1 nav-bar1 left-panel1 primary1 secondary1 ">
	<div class="container-fluid h-100">
		<div class="row h-100">
			<!-- Left Side -->
			<div id="sidebar-left" class="col-sm-4 col-4 col-md-2 d-none d-md-block position-relative">
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
					<div class="col align-self-center top-bar">
						<div class="row justify-content-between">
							@yield('top-bar')
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