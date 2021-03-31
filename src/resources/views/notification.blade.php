@extends('felaraframe::page')
@php
    app()->FeFrame->enqueueResource(asset('/feiron/fe_theme/js/modules/notification.js'),'footerscripts');
@endphp

@section('main-content')
<x-fe_theme::fe-portlet id="fe_notification" class="bg-white fenotification-container h-100 mb-0">
    <fe-notification api-url="{{route('notificationAPI')}}" mid="{{$MID}}" />
</x-fe_theme::fe-portlet>
@endsection
