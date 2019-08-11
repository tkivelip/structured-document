<div class="card{{ !empty($class) ? ' '.$class : ''}}">
    @if($header ?? false)
        <div class="card-header">
            {{ $header }}
        </div>
    @endif
    <div class="card-body">
        @if($content ?? false)
            {{ $content }}
        @else
            <h5 class="card-title">{{ $title ?? '' }}</h5>
            <p class="card-text"> {{ $text ?? ''}}</p>
        @endif
    </div>
</div>