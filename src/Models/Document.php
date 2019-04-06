<?php

namespace Laramate\StructuredDocument\Models;

use Laramate\StructuredDocument\Interfaces\StructuredContainerInterface;
use Laramate\StructuredDocument\Interfaces\StructuredItemInterface;
use Laramate\StructuredDocument\Models\Traits\Containerable;
use Laramate\StructuredDocument\Models\Traits\HasBlocks;
use Laramate\StructuredDocument\Models\Traits\HasLayers;
use Laramate\StructuredDocument\Models\Traits\Structurable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use LaravelFlexProperties\Traits\HasFlexProperties;
use Mindtwo\DynamicMutators\Traits\HasDynamicMutators;
use mindtwo\LaravelAutoCreateUuid\AutoCreateUuid;

class Document extends Model implements StructuredItemInterface, StructuredContainerInterface
{
    use AutoCreateUuid,
        HasDynamicMutators,
        HasFlexProperties,
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
        'title'         => 'string',
        'meta_title'    => 'string',
        'meta_keywords' => 'text',
    ];

    protected $fillable = [
        'title',
        'meta_title',
        'meta_keywords',
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

        static::saved(function ($document) {
            $document->createMissingLayers();
            $document->createMissingBlocks();
        });
    }

    /**
     * Get the structured item type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'document';
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
     * Child documents.
     *
     * @return HasMany
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
}
