<?php

namespace Laramate\StructuredDocument\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laramate\StructuredDocument\Interfaces\StructuredItemInterface;
use Laramate\StructuredDocument\Models\Traits\HasMediaConversions;
use Laramate\StructuredDocument\Models\Traits\Structurable;
use Laramate\StructuredDocument\Models\Traits\ModelArrayAccess;
use Laramate\Tag\Models\Traits\Taggable;
use Laramate\FlexProperties\Traits\HasFlexProperties;
use Mindtwo\DynamicMutators\Traits\HasDynamicMutators;
use Mindtwo\LaravelAutoCreateUuid\AutoCreateUuid;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class Block extends Model implements StructuredItemInterface, HasMedia, \ArrayAccess
{
    use HasDynamicMutators,
        HasFlexProperties,
        ModelArrayAccess,
        HasMediaTrait,
        HasMediaConversions,
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

    public function registerMediaCollections()
    {
        foreach (config('document.media_conversions') as $collection=>$conversions) {
            $this->addMediaCollection($collection);
        }
    }

    public function registerMediaConversions(Media $media = null)
    {
        foreach (config('document.media_conversions') as $collection=>$conversions) {

            foreach ($conversions as $conversionKey => $config) {
                $conversion = $this->addMediaConversion($conversionKey);

                if (isset($config['width'])) {
                    $conversion->width($config['width']);
                }

                if (isset($config['height'])) {
                    $conversion->width($config['height']);
                }

                if (isset($config['crop'])) {
                    $conversion->crop($config['crop'], $config['width'], $config['height']);
                }
            }
            $conversion->performOnCollections($collection);

        }
    }

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
