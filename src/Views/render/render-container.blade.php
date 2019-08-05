<div class="item_container" id="item_container_{{ $item->id }}">

    @include($item->getTemplateKey(), ['container'=>$item, 'items'=>$item->getChildren()])

</div>