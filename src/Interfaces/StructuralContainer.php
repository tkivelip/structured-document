<?php

namespace Laramate\StructuredDocument\Interfaces;

use Illuminate\Support\Collection;

interface StructuralContainer
{
    /**
     * Get all child items.
     *
     * @return Collection
     */
    public function getChildren(): Collection;
}
