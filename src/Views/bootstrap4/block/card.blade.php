@extract([
    'class'  => $class ?? '',
    'header' => $header ?? $item->header ?? '',
    'title'  => $title ?? $item->title ?? '',
    'text'   => $text ?? $item->text ?? '',
    'body'   => $slot ?? $body ?? $item->body ?? '',
])

<div class="card {{ $class }}">
    @if($header)
        <div class="card-header">
            {{ $header }}
        </div>
    @endif
    <div class="card-body">
        @if($body)
            {{ $body }}
        @else
            <h5 class="card-title">{{ $title }}</h5>
            <p class="card-text"> {{ $text }}</p>
        @endif
    </div>
</div>