@section('top-bar')
    <div class="col d-flex topbar-controls ">
        <div class="toggleTarget d-md-none border-0" tg-target="#sidebar-left">
            <i class="fas fa-bars fa-lg" onclick="window.fe_frame.toggleClass(this,'fa-times')"></i>
        </div>
        <div class="ms-2 custom-scroll nav-controls d-flex">
            <div class="menu-direction-control scroll-x align-self-center mx-1" data-direction="left"><i class="fas fa-lg fa-chevron-left"></i></div>
            <div class="nav-container scroll-container px-0">
                <ul class="px-0 mx-0 nav-icons mb-1">
                    @yield('topbar_menus')
                </ul>
            </div>
            <div class="menu-direction-control scroll-x align-self-center mx-1" data-direction="right"><i class="fas fa-lg fa-chevron-right"></i></div>
        </div>
    </div>
    <div class="col justify-content-end d-flex">
        user info
    </div>
@endsection