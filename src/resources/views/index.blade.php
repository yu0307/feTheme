@includeIf('fe_theme::topbar')
@includeIf('fe_theme::leftpanel')
<section class="body h-100 
				theme-{{strtolower(str_replace(' ','-',($siteInfo['themeSettings']['page_template']??'style-1')))}} 
				theme-{{strtolower(str_replace(' ','-',($siteInfo['themeSettings']['page_color']??'Dark')))}} 
				main-bg-{{strtolower(str_replace(' ','-',($siteInfo['themeSettings']['page_bgcolor']??'Color4')))}} 
				menu-{{strtolower(str_replace(' ','-',($siteInfo['themeSettings']['sb_showon']??'Always')))}}">
	<div class="container-fluid h-100">
		<div class="row h-100">
			<!-- Left Side -->
			<div id="sidebar-left" class="col-sm-4 col-4 col-md-2 d-none d-md-block position-relative nav-menu-{{strtolower($siteInfo['themeSettings']['sb_initbh']??'Normal')}}">
				<div class="row top-left nav-bar brand">
					<div class="col align-self-center d-flex align-items-center flex-column">
						<a class="navbar-brand me-0 text-truncate w-100 d-block text-capitalize" href="{{Route::has('home')?route('home'):'/'}}">@yield('siteName',config('app.name'))</a>
						<div class="left-bar-ctrl">
							<i class="fas fa-indent fa-lg d-none" dir="expand"></i>
						</div>
					</div>
				</div>
				<div class="row left-panel h-100">
					<div class="col px-0 py-1">
						@yield('left-panel')
					</div>
				</div>
			</div>
			<!-- Right Side -->
			<div class="col position-relative h-100 overflow-auto">
				<div class="row top-main nav-bar menu-{{strtolower($siteInfo['themeSettings']['tb_location']??'Fixed')}}">
					<div class="col align-self-center top-bar">
						<div class="row justify-content-between">
							@yield('top-bar')
						</div>
					</div>
				</div>
				<div class="row main h-100">
					<div class="col p-2" size-auto-capable='false'>
						<div class="main-content scroll-container h-100">
							<main class="h-100">
								@yield('main-content')
							</main>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stack('endBody')
@push('footerscripts')
	<script type="text/javascript">
		@stack('JsBeforeReady')
		window.ready(()=>{
			@stack('DocumentReady')
		});
	</script>
@endpush