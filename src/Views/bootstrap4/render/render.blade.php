@if(Lsd::isStructurable($item ?? null))
    @include($item->template, array_merge($item->toArray(), ['item'=>$item]))
@endif
