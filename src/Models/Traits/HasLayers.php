<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Laramate\StructuredDocument\Interfaces\StructuredContainerInterface;
use Laramate\StructuredDocument\Models\Layer;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasLayers
{
    /**
     * Related child layers.
     *
     * @return MorphMany
     */
    public function layers(): MorphMany
    {
        return $this->morphMany(Layer::class, 'linkable');
    }

    /**
     * Get related child layers with named keys.
     *
     * @return Collection
     */
    public function getLayers(): Collection
    {
        return $this->layers->mapWithKeys(function ($layer) {
            return [$layer->name ?? 'layer_'.$layer->id => $layer];
        });
    }

    /**
     * Get related layer by name.
     *
     * @param string $name
     *
     * @return StructuredContainerInterface|null
     */
    public function getLayer(string $name): ?StructuredContainerInterface
    {
        return $this->layers->where('name', $name)->first();
    }
}
