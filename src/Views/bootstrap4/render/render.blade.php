
@if(Lsd::isContainerable($item ?? null))
    @include($item->getTemplateKey(), ['item'=>$item, 'items'=>$item->getChildren()])
@elseif(Lsd::isStructurable($item ?? null))
    @include($item->getTemplateKey(), ['item'=>$item])
@endif
