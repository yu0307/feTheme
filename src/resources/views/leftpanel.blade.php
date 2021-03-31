@section('main_menu')
    @renderMenu(app()->FeFrame->menu->getMenu('default'))
@endsection


@section('left-panel')
<div id="left-panel" class="h-100 d-flex flex-column">
    <div class="sidebar-top prof-{{strtolower(str_replace(' ','-',($siteInfo['themeSettings']['sb_topdisplay']??'Mini Profile Image')))}}">
        <div class="user-image">
            <img src="{{app()->FeFrame->GetProfileImage(300)}}" class="img-fluid rounded-circle">
        </div>
        <i class="usr-default-icon fab fa-grav fa-4x d-none"></i>
        <div class="user-details">
            <h4 class="text-truncate">@yield('user_name',(auth()->user()->name??''))</h4>
            @yield('user_subctrl')
        </div>
    </div>
    <div id="nav-main-left" overflow-x="visible-hidden" class="custom-scroll flex-fill menu-{{strtolower($siteInfo['themeSettings']['sb_structure']??'Normal')}}">
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