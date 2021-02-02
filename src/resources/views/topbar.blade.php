@section('top-bar')
    <div class="col d-flex topbar-controls ">
        <div class="toggleTarget d-md-none border-0" tg-target="#sidebar-left">
            <i class="fas fa-bars fa-lg" onclick="window.fe_frame.toggleClass(this,'fa-times')"></i>
        </div>
        <div class="ms-2 nav-controls">
            <div class="custom-scroll nav-container px-0">
                <ul class="px-0 mx-0 nav-icons mb-1">
                    @yield('topbar_menus')
                    <!-- testing remove on production -->
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                    <li><i class="fab fa-lg fa-cloudversify"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col justify-content-end d-flex">
        user info
    </div>
@endsection