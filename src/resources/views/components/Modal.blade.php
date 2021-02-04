<div {{$attributes->merge(['class' => "modal fade"])}} tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{$dialogOptions??''}}">
        <div class="modal-content">
            <div class="modal-header {{ $headerBg??'bg-primary' }}">
                <h5 class="modal-title">{{ $header??'' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            <div class="modal-footer {{ $footerBg??'bg-gray-light' }}">
                @if(isset($footer))
                    {!! $footer??'' !!}
                @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->