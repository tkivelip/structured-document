<?php

namespace Laramate\StructuredDocument\Helpers;

use Laramate\StructuredDocument\Interfaces\StructuralContainer;
use Laramate\StructuredDocument\Interfaces\StructuralItem;

class Lsd
{
    public static function isStructurable($var)
    {
        return is_object($var)
            && is_subclass_of($var, StructuralItem::class);
    }

    public static function isContainerable($var)
    {
        return is_object($var)
            && is_subclass_of($var, StructuralContainer::class);
    }
}
