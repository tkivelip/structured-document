<?php

namespace Laramate\StructuredDocument\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laramate\StructuredDocument\Interfaces\StructuredItemInterface;
use Laramate\StructuredDocument\Models\Traits\Structurable;
use Laramate\Tag\Models\Traits\Taggable;
use LaravelFlexProperties\Traits\HasFlexProperties;
use Mindtwo\DynamicMutators\Traits\HasDynamicMutators;
use mindtwo\LaravelAutoCreateUuid\AutoCreateUuid;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Block extends Model implements StructuredItemInterface, HasMedia
{
    use HasDynamicMutators,
        HasFlexProperties,
        HasMediaTrait,
        AutoCreateUuid,
        SoftDeletes,
        Structurable,
        Taggable;

    /**
     * Flex properties.
     *
     * @var array
     */
    public $flex_properties = [
        'title'   => 'string',
        'content' => 'text',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'deleted_at',
    ];

    /**
     * Get the structured item type.
     *
     * @return string
     */
    public function getType(): string
    {
        return 'block';
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
     * Get headline as html string.
     *
     * @return string
     */
    public function getHtmlHeadlineAttribute(): string
    {
        if (empty($this->title)) {
            return '';
        }

        return "<h{$this->heading_order}>{$this->title}</h{$this->heading_order}>";
    }
}
