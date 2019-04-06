<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Laramate\StructuredDocument\Interfaces\StructuredItemInterface;

trait Containerable
{
    /**
     * Get a child item by its name.
     *
     * @param string $name
     *
     * @return StructuredItemInterface|null
     */
    public function getChild(string $name): ?StructuredItemInterface
    {
        return $this->getChildren()->where('name', $name)->first();
    }
}
