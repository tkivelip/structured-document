<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Laramate\StructuredDocument\Interfaces\StructuralContainer;
use Illuminate\Support\Str;

trait Structurable
{
    /**
     * Determinate if the item can have child items.
     *
     * @return bool
     */
    public function isContainer(): bool
    {
        return $this instanceof StructuralContainer;
    }

    /**
     * Get the template key.
     *
     * @return string
     */
    public function getTemplateKey(): string
    {
        return 'lsd::block.block';
    }
}
