<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Laramate\StructuredDocument\Interfaces\StructuredContainerInterface;
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
        return $this instanceof StructuredContainerInterface;
    }

    /**
     * Get the template base key.
     *
     * @return string
     */
    protected function getTemplateBaseKey(): string
    {
        $path = trim(config('document.'.Str::plural($this->getType()).'.view_path'), '/');

        return str_replace('/', '.', $path);
    }

    /**
     * Get the template key.
     *
     * @return string
     */
    public function getTemplateKey(): string
    {
        return $this->getTemplateBaseKey().'.'.$this->template;
    }
}
