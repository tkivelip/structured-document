<?php

namespace Laramate\StructuredDocument\Models;

use Illuminate\Support\Collection;
use Laramate\StructuredDocument\Interfaces\StructuralContainer;
use Laramate\StructuredDocument\Models\Abstracts\Item;
use Laramate\StructuredDocument\Models\Traits\Containerable;
use Laramate\StructuredDocument\Models\Traits\HasBlocks;
use Laramate\StructuredDocument\Models\Traits\HasLayers;

class Layer extends Item implements StructuralContainer
{
    use Containerable;
    use HasBlocks;
    use HasLayers;

    /**
     * Flex properties.
     *
     * @var array
     */
    public $flex_properties = [
        'title' => 'string',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'title',
        'template',
        'children',
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Get all child items.
     *
     * @return Collection
     */
    public function getChildrenAttribute(): Collection
    {
        return collect($this->blocks)->merge($this->layers);
    }
}
