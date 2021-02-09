<div class="fe-uploaders bg-default p-2 my-1">
    <fe-uploader {{$attributes->merge(['class' => ("fe-uploader")])}}>
        {{$slot}}
    </fe-uploader>
</div>

@pushonce('footerscripts','FeFileUpload')
    <script type="text/javascript" src="{{asset('/feiron/fe_theme/js/modules/feUploader.js')}}"></script> <!-- upload control script -->
@endpushonce