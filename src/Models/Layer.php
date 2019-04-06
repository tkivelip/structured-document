<?php

namespace Laramate\StructuredDocument\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Laramate\StructuredDocument\Interfaces\StructuredContainerInterface;
use Laramate\StructuredDocument\Interfaces\StructuredItemInterface;
use Laramate\StructuredDocument\Models\Traits\Containerable;
use Laramate\StructuredDocument\Models\Traits\HasBlocks;
use Laramate\StructuredDocument\Models\Traits\HasLayers;
use Laramate\StructuredDocument\Models\Traits\Structurable;
use LaravelFlexProperties\Traits\HasFlexProperties;
use Mindtwo\DynamicMutators\Traits\HasDynamicMutators;
use mindtwo\LaravelAutoCreateUuid\AutoCreateUuid;

class Layer extends Model implements StructuredItemInterface, StructuredContainerInterface
{
    use HasDynamicMutators,
        HasFlexProperties,
        AutoCreateUuid,
        Structurable,
        Containerable,
        HasBlocks,
        HasLayers;

    /**
     * Flex properties.
     *
     * @var array
     */
    public $flex_properties = [
        'title' => 'string',
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
     * Get the structured item type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'layer';
    }

    /**
     * Related structured item.
     *
     * @return MorphTo
     */
    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get all child items.
     *
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return collect($this->blocks)->merge($this->layers);
    }
}
