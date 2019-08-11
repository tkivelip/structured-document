@if(Lsd::isStructurable($item ?? null) || is_array($item ?? null))
    @php($item = is_array($item) ? $item : $item->toArray())
    @include($item['template'], array_merge($item, ['item'=>$item]))
@endif
