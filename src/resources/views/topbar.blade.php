@section('top-bar')
@php
    $newMails=$newMails??app()->FeFrame->COMs()->getMessage();
@endphp
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
        <ul class="nav-icons mb-0 no-decoration px-0 d-flex align-items-center">

            <li class="dropdown position-relative h-100 d-flex" id="notifications-header">
                <!-- NOTIFICATION DROPDOWN MENU -->
                <a href="#" class="no-decoration ms-1 d-flex align-items-center" 
                    data-bs-toggle="dropdown"
                    type="button" 
                    data-bs-display="static" 
                    aria-expanded="false">
                    <i class="far fa-bell fa-lg"></i>
                    <span class="badge bg-danger badge-header">{{$newMails?count($newMails):''}}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="fan"></li>
                    <li class="dropdown-header clearfix">
                        <p class="m-0 float-end">you have {{count($newMails)??0}} New Notifications</p>
                    </li>
                    @foreach ($newMails??[] as $mail)
                        <li class="clearfix message p-2">
                            <div class="clearfix bd-green border-bottom p-5">
                                <a href="{{route('LF_Notifications',['MID'=>$mail->id])}}">
                                    <div>
                                        <strong>{{$mail->Sender->name??'System'}}</strong> 
                                        <small class="float-end text-muted me-1">
                                            <i class="far fa-clock me-1 fa-sm"></i>{{$mail->created_at->format('(D)M-d Y')}}
                                        </small>
                                    </div>
                                    <p>{!!Illuminate\Support\Str::limit($mail->subject,150,' ...')!!}</p>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="dropdown position-relative" id="user-header">
                <!-- USER DROPDOWN MENU -->
                <a href="#" id="user-controls" class="no-decoration ms-1 d-flex align-items-center" 
                    data-bs-display="static" 
                    type="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                    <img class="usr-img img-fluid img-thumbnail rounded-circle float-start" src="{{app()->FeFrame->GetProfileImage()}}">
                    <span class="username d-none d-sm-block d-inline-block text-truncate">Hi, @yield('user_name',(auth()->user()->name??''))</span>
                </a>
                @auth
                <ul class="dropdown-menu no-decoration px-0" aria-labelledby="user-controls">
                    <li class="fan"></li>
                    @if (Route::has('Profile'))
                    <li>
                        <a href="{{route('Profile')}}"><i class="fas fa-user-circle"></i><span class="ms-1">Account Settings</span></a>
                    </li>
                    @endif
                    @if (Route::has('LF_Notifications'))
                    <li>
                        <a href="{{route('LF_Notifications')}}"><i class="fas fa-envelope-open-text"></i><span class="ms-1">Notifications</span></a>
                    </li>
                    @endif
                    @if (Route::has('LF_controlpanel'))
                    @role('admin')
                        <li>
                            <a href="{{route('LF_controlpanel')}}"><i class="fas fa-cogs"></i><span class="ms-1">Control Panel</span></a>
                        </li>
                    @endrole
                    @endif

                    @if (Route::has('logout') || Route::has('Fe_Logout'))
                    <li>
                        <a href="{{route('Fe_Logout')??route('logout')}}"><i class="fas fa-sign-out-alt"></i><span class="ms-1">Logout</span></a>
                    </li>
                    @endif
                </ul>
                @endauth
            </li>
        </ul>
    </div>
@endsection