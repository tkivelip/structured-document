<?php

namespace Laramate\StructuredDocument\Models\Traits;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

trait HasMediaConversions
{
    use HasMediaTrait;

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
