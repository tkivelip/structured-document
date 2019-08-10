<?php

namespace Laramate\StructuredDocument\Models\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laramate\FlexProperties\Traits\HasFlexProperties;
use Laramate\StructuredDocument\Interfaces\StructuralItem;
use Laramate\StructuredDocument\Models\Traits\Structurable;
use Mindtwo\DynamicMutators\Traits\HasDynamicMutators;
use mindtwo\LaravelAutoCreateUuid\AutoCreateUuid;
use ReflectionClass;
use ReflectionException;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

abstract class Item extends Model implements StructuralItem, HasMedia
{
    use Structurable;
    use HasDynamicMutators;
    use HasFlexProperties;
    use HasMediaTrait;
    use AutoCreateUuid;
    use SoftDeletes;

    /**
     * Get the structured item type.
     *
     * @throws ReflectionException
     *
     * @return string
     */
    public function getStructuralTypeAttribute(): string
    {
        $reflect = new ReflectionClass($this);

        return strtolower($reflect->getShortName());
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
}
