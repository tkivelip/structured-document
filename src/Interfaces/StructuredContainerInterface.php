<?php

namespace Laramate\StructuredDocument\Interfaces;

use Illuminate\Support\Collection;

interface StructuredContainerInterface
{
    /**
     * Get all child items.
     *
     * @return Collection
     */
    public function getChildren(): Collection;
}
