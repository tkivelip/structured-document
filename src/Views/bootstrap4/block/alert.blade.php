<div class="alert alert-{{$type ?? 'success'}}{{ !empty($class) ? ' '.$class : ''}}" role="alert">
    @if($title ?? false)
        <h4 class="alert-heading">{{ $title }}</h4>
    @endif
    {{ $slot ?? $content ?? ''}}
</div>