<?php

namespace Laramate\StructuredDocument\Models;

use Laramate\StructuredDocument\Models\Abstracts\Item;
use Laramate\StructuredDocument\Models\Traits\HasMediaConversions;

class Block extends Item
{
    use HasMediaConversions;

    /**
     * Flex properties.
     *
     * @var array
     */
    public $flex_properties = [
        'title'     => 'string',
        'content'   => 'text',
        'header'    => 'string',
        'text'      => 'text',
        'link'      => 'string',
        'link_text' => 'string',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'title',
        'content',
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
}
