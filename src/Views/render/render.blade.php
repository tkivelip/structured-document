
@if(Lsd::isStructurable($item ?? null))
    @if(Lsd::isContainarable($item))
        @include($item->getTemplateKey(), ['item'=>$item, 'items'=>$item->getChildren()])
    @else
        @include($item->getTemplateKey(), ['item'=>$item])
    @endif
@endif
