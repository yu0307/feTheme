@extends('felaraframe::layout')
@php
    app()->FeFrame->enqueueResource(asset('/feiron/fe_theme/css/usrProfile.css'),'headerstyles');
    foreach(app()->frameOutlet->OutletResources('Fe_FrameProfileOutlet') as $asset){
        app()->FeFrame->enqueueResource($asset,'OutletResource');
    }
@endphp

@section('Prof_control_tab_contents')
    @php
        $menu='';
    @endphp
    @if ($Editable)
        @foreach (app()->frameOutlet->getOutlet('Fe_FrameProfileOutlet') as $OutletItem)
            @php
                $active = empty($menu);
                $ID=str_replace(' ','_',$OutletItem->MyName());
                $menu.='<li class="nav-item '.($active?'active':'').'" role="presentation">
                            <a 
                                class="nav-link '.($active?'active':'').'" 
                                aria-selected="'.($active?'true':'false').'" 
                                data-bs-target="#'.$ID.'" 
                                role="tab" 
                                href="#'.$ID.'" 
                                data-bs-toggle="tab">'.$OutletItem->MyName().'</a>
                        </li>';
            @endphp
            <div class="tab-pane fade h-100 {{$active?'show active':''}}" id="{{$ID}}" role="tabpanel">
                @include($OutletItem->getView()->getname())
            </div>
        @endforeach
    @endif
@endsection

@section('main-content')
<x-fe_theme::fe-portlet id="Profile_Panel" class="bg-white Profile-container h-100 mb-0">
    @empty($User)
    <h4 class=" alert t-center text-center">User not found ...</h4>
    @else
    <div class="container-fluid d-flex flex-column h-100">
        <div class="row">
            <div class="col-md-12">
                <div class="panel bg-white">
                    <div class="panel-body p-3 p-sm-1">
                        <div class="align-items-center row">
                            <div class="col-2 d-none d-sm-block">
                                <div class="ms-3 overflow-hidden d-inline-block img-lg img-responsive mx-auto position-relative rounded-circle usrProfile {{$Editable?'editable':''}}">
                                    <img class="w-100 h-auto" src="{{app()->FeFrame->GetProfileImage(120,false,null,$User)}}" alt="avatar">
                                </div>
                            </div>
                            <div class="col-10">
                                <h2 class="c-dark fs-2 fw-light mb-1">{{$User->title??$User->name}}</h2>
                                <p class="c-gray mb-1 f-16">{{$User->subtitle??''}}</p>
                                <p class="c-gray mb-1">{{$User->subtext??''}}</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-fill row my-2">
            <div class="col-md-12 p-10 h-100">
                <div class="tab_left h-100">
                    <ul class="nav nav-tabs nav-primary h-100 f-16" role="tablist">
                        {!!$menu!!}
                    </ul>
                    <div class="tab-content h-100">
                        @yield('Prof_control_tab_contents')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endempty
</x-fe_theme::fe-portlet>
@endsection