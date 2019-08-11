<?php

namespace Laramate\StructuredDocument\Models\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Laramate\FlexProperties\Traits\HasFlexProperties;
use Laramate\StructuredDocument\Exceptions\StructuredDocumentException;
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

    protected $structural_config;

    protected static function boot()
    {
        parent::boot();
    }

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

    /**
     * Set item type.
     *
     * @param string $type
     *
     * @throws StructuredDocumentException
     *
     * @return Item
     */
    public function setTypeAttribute(string $type): self
    {
        if (!empty($this->attributes['type'])) {
            throw new StructuredDocumentException('Type change after initialization is not allowed.');
        }

        $this->attributes['type'] = $type;

        return $this;
    }

    /**
     * Get item type.
     *
     * @param null $value
     *
     * @return string
     */
    public function getTypeAttribute($value = null): string
    {
        return $value ?? $this->structural_type;
    }

    /**
     * Get a structural configuration value.
     *
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public function structuralConfig($key, $default = null)
    {
        if (empty($this->structural_config)) {
            $this->structural_config = $this->composeStructuralConfig($this->type, $this->structural_type);
        }

        return Arr::get($this->structural_config, $key, $default);
    }

    /**
     * Compose item config.
     *
     * @param string $type
     * @param string $structuralType
     *
     * @return array|null
     */
    protected function composeStructuralConfig(string $type, string $structuralType): ?array
    {
        $config = Config::get("lsd.{$structuralType}.items");

        return collect($config)->keyBy('name')->get($type);
    }

    /**
     * Get the item template.
     *
     * @return string
     */
    public function getTemplateAttribute(): string
    {
        return $this->structuralConfig(
            'template',
            sprintf('lsd::%1$s.%1$s', $this->structural_type)
        );
    }

    /**
     * Renders the item as string.
     *
     * @throws \Throwable
     *
     * @return string
     */
    public function render(): string
    {
        $themeVars = array_merge(
            $this->toArray(),
            ['item' => $this]
        );

        return view($this->template, $themeVars)->render();
    }
}
