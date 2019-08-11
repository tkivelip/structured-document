<?php

namespace Laramate\StructuredDocument\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Laramate\StructuredDocument\Interfaces\StructuralContainer;
use Laramate\StructuredDocument\Models\Abstracts\Item;
use Laramate\StructuredDocument\Models\Traits\Containerable;
use Laramate\StructuredDocument\Models\Traits\HasBlocks;
use Laramate\StructuredDocument\Models\Traits\HasLayers;

class Document extends Item implements StructuralContainer
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
        'title'         => 'string',
        'meta_title'    => 'string',
        'meta_keywords' => 'text',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'title',
        'template',
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    protected $config = [
        'layers' => [
            'intro'   => [],
            'content' => [],
        ],
        'blocks' => [
            'description' => [],
        ],
    ];

    /**
     * Boot model.
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Get all child items.
     *
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->getLayers()->merge($this->getBlocks());
    }

    /**
     * Create missing layers.
     */
    public function createMissingLayers()
    {
        collect($this->config['layers'])->each(function ($config, $name) {
            if (! $this->getLayer($name)) {
                $this->layers()->create(array_merge($config, ['name' => $name]));
            }
        });
    }

    /**
     * Create missing blocks.
     */
    public function createMissingBlocks()
    {
        collect($this->config['blocks'])->each(function ($config, $name) {
            if (! $this->getBlock($name)) {
                $this->blocks()->create(array_merge($config, ['name' => $name]));
            }
        });
    }

    /**
     * Parent document.
     *
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(static::class, 'id', 'parent_id');
    }

    /**
     * Parent document.
     *
     * @return HasOne
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    /**
     * Get the document url.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('frontend.document.show', ['slug'=>$this->slug]);
    }

    /**
     * Get page deepth.
     *
     * @return int
     */
    public function getDeepthAttribute()
    {
        return $this->parent_id ? $this->parent->deepth + 1 : 0;
    }

    public function layer($itemType)
    {
        return $this->getLayers()->where('item_type', $itemType)->first();
    }
}
