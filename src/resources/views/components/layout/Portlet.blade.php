<div {{$attributes->merge(['class' => "panel portlet d-flex flex-column"])}} >
    @isset($header)
    <div class="panel-header bg-{{$headerBg??'dark'}} {{(($headerControls??false)===true)?'panel-controls':''}}">
        {!!$header??''!!}
    </div>
    @endisset

    <div class="panel-content flex-fill">
        {{ $slot }}
    </div>
    
    @isset($footer)
    <div class="panel-footer bg-{{$footerBg??'none'}}">
        {!!$footer??''!!} 
    </div>
    @endisset
</div>