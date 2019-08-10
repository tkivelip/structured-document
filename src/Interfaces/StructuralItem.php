<?php

namespace Laramate\StructuredDocument\Interfaces;

interface StructuralItem
{
    /**
     * Get the structured item type.
     *
     * @return string
     */
    public function getStructuralTypeAttribute(): string;

    /**
     * Determinate if the item can have child items.
     *
     * @return bool
     */
    public function isContainer(): bool;
}
