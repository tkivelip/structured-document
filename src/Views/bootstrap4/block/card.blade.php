<div class="card{{ isset($class) ? ' '.$class : ''}}">
    @if($item->header)
        <div class="card-header">
            {{ $item->header }}
        </div>
    @endif
    <div class="card-body">
        @if($item->content)
            {{ $item->content }}
        @else
            <h5 class="card-title">{{ $item->title }}</h5>
            <p class="card-text"> {{ $item->text }}</p>
            @if($item->link)
                <p class="card-link"><a href="{{ $item->link }}">{{ $item->link_text }}</a> </p>
            @endif
        @endif
    </div>
</div>