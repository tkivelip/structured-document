<div class="content-block{{ !empty($class) ? ' '.$class : ''}}">
    @if($title ?? false)
        <h{{  $heading_order ?? '2' }}>{{ $title }}</h{{  $heading_order ?? '2' }}>
    @endif
    {{ $slot ?? $content ?? ''}}
</div>