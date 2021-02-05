<div {{$attributes->merge(['class' => ("panel-group panel-accordion accordion ".($style??'default').'-accordion')])}} {{$id?('id='.$id):''}} >

    @foreach ($items as $item)
        <div class="panel panel-default accordion-item">
            <div class="panel-heading accordion-header">
                <h4>
                    <a 
                        class="{{($item['activate']??false)?'':'collapsed'}}" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#{{$item['key']}}" 
                        aria-expanded="{{($item['activate']??false)?'true':'false'}}" 
                        aria-controls="{{$item['key']}}">
                        {{$item['title']}}
                    </a>
                </h4>
            </div>
            <div 
                id="{{$item['key']}}" 
                class="panel-collapse accordion-collapse collapse {{($item['activate']??false)?'show':''}}" 
                aria-expanded="{{($item['activate']??false)?'true':'false'}}" 
                {{$id?('data-bs-parent=#'.$id):''}}>
                <div class="panel-body">
                    {{$item['body']}}
                </div>
            </div>
        </div>
    @endforeach

</div>