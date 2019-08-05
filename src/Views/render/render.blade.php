@php
    $item = isset($item) ? $item : $from->getChild($name);
@endphp

@if($item->isContainer())
    <x-render-container :item="$item"/>
@else
    <x-render-item :item="$item"/>
@endif