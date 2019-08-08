<div class="item" id="item_{{ $item->id }}">

    @include($item->getTemplateKey(), ['item'=>$item])

</div>
