<?php

namespace Laramate\StructuredDocument\Models;

use Laramate\StructuredDocument\Abstracts\Item;
use Laramate\StructuredDocument\Models\Traits\HasMediaConversions;
use Spatie\MediaLibrary\Models\Media;

class Block extends Item
{
    use HasMediaConversions;

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
}
