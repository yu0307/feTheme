@extends('felaraframe::page')
@php
    app()->FeFrame->enqueueResource(asset('/feiron/fe_theme/css/controlpanel.css'),'headerstyles');
    app()->FeFrame->enqueueResource(asset('/feiron/fe_theme/js/modules/controlPanel.js'),'footerscripts');
    foreach(app()->frameOutlet->OutletResources('Fe_FrameOutlet') as $asset){
        app()->FeFrame->enqueueResource($asset,'OutletResource');
    }
@endphp

@section('control_tab_contents')
    @php
        $menu='';
        $LF_CRUD='';
    @endphp
    @foreach (app()->frameOutlet->getOutlet('Fe_FrameOutlet') as $OutletItem)
        @php
            $ID=str_replace(' ','_',$OutletItem->MyName());
            $menu.='<li class="nav-item" role="presentation">
                        <a 
                            class="nav-link"
                            data-bs-target="#'.$ID.'" 
                            role="tab" 
                            href="#'.$ID.'" 
                            data-bs-toggle="tab">'.$OutletItem->MyName().'</a>
                    </li>';
        @endphp
        <div class="tab-pane fade h-100" id="{{$ID}}" role="tabpanel">
            @php
                $view=$OutletItem->getView();
                if ($__env->exists($view->Name(),$view->getData())){
                        echo $__env->make($view->Name(),$view->getData())->render(); 
                }
            @endphp
        </div>
        @push('LF_CRUD')
            <div class="LF_CRUD row {{$ID}}" id="{{($ID.'_CRUD')}}">
                @yield($ID.'_CRUD')
            </div>
        @endpush
    @endforeach
@endsection

@section('main-content')
<x-fe_theme::fe-portlet id="controlPanel" class="bg-white Profile-container h-100 mb-0">
    <x-slot name="header">
        <h3>Admin Control Panel</h3>
    </x-slot>
    <ul class="nav nav-tabs nav-primary f-16" role="tablist">
        <li class="nav-item " role="presentation">
            <a data-bs-target="#General"  href="#General" role="tab" class="nav-link active" data-bs-toggle="tab" aria-selected="true">General</a>
        </li>
        {!!$menu!!}
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade h-100 active show in" id="General" role="tabpanel" data_target="{!!route('LF_controlpanel')!!}">
            <p class="light alert alert-info">General configurations.</p>
            {!!app()->FeFrame->RenderSiteSettings()!!}
            <div class="clearfix"></div>
            <button class="btn btn-primary pull-right btn_site_settings_save">Update Site Settings</button>
            <div class="clearfix"></div>
        </div>
        @yield('control_tab_contents')
    </div>
</x-fe_theme::fe-portlet>
@endsection
@push('lastContent')
<x-fe_theme::fe-modal id="control_CRUD">
    <x-slot name="footer">
        <div class="row">
            <div class="buttonSlot col-md-8 col-sm-12">
            </div>
            <div class="col-md-4 col-sm-12">
                <button type="button" class="btn btn-default float-end" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </x-slot>
    <div class="loading text-center">
        <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>
        <h4 class="text-center t-center">Loading Contents ...</h4>
    </div>
    <div class="CRUD_ctr_Area">
        <div class="LF_CRUD row" id="General_CRUD">
            
        </div>
        @stack('LF_CRUD')
    </div>
</x-fe_theme::fe-modal>
@endpush
