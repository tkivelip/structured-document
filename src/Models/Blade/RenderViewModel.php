<?php

namespace Laramate\StructuredDocument\Models\Blade;

use Laramate\StructuredDocument\Facades\Lsd;
use Spatie\BladeX\ViewModel;

class RenderViewModel extends ViewModel
{
    protected $item;

    protected $layer;

    protected $block;

    public function __construct($item, string $layer='')
    {
        $this->item = $item;
        $this->layer = $layer;
    }

    public function lsd()
    {
        return $this->item;
    }

    public function isStructural($var): bool
    {
        return Lsd::isStructurable($this->item);
    }

    public function getValue(string $key)
    {
        return $this->item->$key;
    }
}
