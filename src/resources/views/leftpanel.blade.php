@section('main_menu')
    @renderMenu(app()->FeFrame->menu->getMenu('default'))
@endsection


@section('left-panel')
<div id="left-panel" class="h-100">
    @switch(($siteInfo['themeSettings']['sb_topdisplay']??'None'))
        @case('Profile Image')
            <div class="sidebar-top big-img" style="display: block;">
                <div class="user-image">
                    <img src="{{app()->FeFrame->GetProfileImage(300)}}" class="img-fluid img-thumbnail bg-dark border-light p-1 rounded-circle">
                </div>
                <h4 class="text-truncate">@yield('user_name',(auth()->user()->name??''))</h4>
                @yield('user_subctrl')
            </div>
            <hr>
            @break
        @case('Mini Profile Image')
            <div class="sidebar-top p-1 mx-0 px-1 small-img clearfix justify-content-evenly d-flex align-items-center" style="display: block;">
                <div class="user-image mx-1">
                    <img src="{{app()->FeFrame->GetProfileImage()}}" class="img-fluid rounded-circle">
                </div>
                <div class="user-details">
                    <h4>@yield('user_name',(auth()->user()->name??''))</h4>
                    @yield('user_subctrl')
                </div>
            </div>
            <hr>
            @break
        @case('Icon')
            <div class="userlogged clearfix m-0 p-0 d-flex justify-content-evenly align-items-center">
                <i class="fab fa-grav fa-4x"></i>
                <div class="user-details">
                    <h4>@yield('user_name',(auth()->user()->name??''))</h4>
                    @yield('user_subctrl')
                </div>
            </div>
            <hr>
            @break
        @default
            <div class="sidebar-top" style="display: none;"></div>
    @endswitch
    <div class="custom-scroll h-100">
        <div class="scroll-container p-0 h-100">
            <ul class="nav-menu nav-sidebar p-0 m-0">
                <!-- SIDEBAR MENU -->
                @yield('main_menu')
            </ul>
        </div>
    </div>
    <div class="position-absolute bottom-0 start-0 end-0">
        <div class="sidebar-footer clearfix p-2">
            <!-- QUICK ACCESS -->
            @yield('sidebar_footer')
        </div>
    </div>
</div>
@endsection