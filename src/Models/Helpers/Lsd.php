<?php

namespace Laramate\StructuredDocument\Models\Helpers;

use Laramate\StructuredDocument\Interfaces\StructuralContainer;
use Laramate\StructuredDocument\Interfaces\StructuralItem;

class LsdHelper
{
    public function isStructurable($var=null)
    {
        $var = $var ?? $this;

        return is_object($var)
            && is_subclass_of($var, StructuralItem::class);
    }

    public function isContainerable($var)
    {
        $var = $var ?? $this;

        return is_object($var)
            && is_subclass_of($var, StructuralContainer::class);
    }

    public function render($item=null)
    {
        $item = $item ?? $this;

        return view($item->template, array_merge($item->toArray(), ['item' =>$item]));
    }
}
