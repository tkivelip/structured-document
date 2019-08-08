<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Laramate\StructuredDocument\Interfaces\StructuralItem;

trait Containerable
{
    /**
     * Get a child item by its name.
     *
     * @param string $name
     *
     * @return StructuralItem|null
     */
    public function getChild(string $name): ?StructuralItem
    {
        return $this->getChildren()->where('name', $name)->first();
    }
}
