<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Laramate\StructuredDocument\Models\Block;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasBlocks
{
    /**
     * Child blocks.
     *
     * @return MorphMany
     */
    public function blocks(): MorphMany
    {
        return $this->morphMany(Block::class, 'linkable');
    }

    /**
     * Get related child blocks with named keys.
     *
     * @return Collection
     */
    public function getBlocks(): Collection
    {
        return $this->blocks->mapWithKeys(function ($block) {
            return [$block->name ?? 'block_'.$block->id => $block];
        });
    }

    /**
     * Get a related block by its name.
     *
     * @param string $name
     *
     * @return Block|null
     */
    public function getBlock(string $name): ?Block
    {
        return $this->blocks->where('name', $name)->first();
    }
}
