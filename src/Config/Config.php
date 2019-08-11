<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    */
    'view_framework' => 'bootstrap4',

   /*
   |--------------------------------------------------------------------------
   | Documents
   |--------------------------------------------------------------------------
   |
   */
    'document' => [
        'items' => [
            [
                'name'     => 'default',
                'template' => 'lsd::document.document',
                'properties' => [
                    [
                        'name' => 'title',
                        'type' => 'string',
                    ],
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Layers
    |--------------------------------------------------------------------------
    |
    */
    'layer' => [
        'items' => [
            [
                'name'     => 'container',
                'template' => 'lsd::layer.container',
                'properties' => [
                    [
                        'name' => 'title',
                        'type' => 'string',
                    ],
                ],
            ],
            [
                'name'     => 'main',
                'template' => 'lsd::layer.main',
                'properties' => [],
            ],
            [
                'name'     => 'jumbotron',
                'template' => 'lsd::layer.jumbotron',
                'properties' => [],
            ],
            [
                'name'     => 'teaser',
                'template' => 'lsd::layer.teaser',
                'properties' => [],
                'repeater' => [
                    'max_items' => 3,
                    'item' =>[
                        [
                            'name' => 'card',
                            'type' => 'blog',
                        ]
                    ]
                ],
            ],
            [
                'name'     => 'footer',
                'template' => 'lsd::layer.footer',
                'properties' => [],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Block configuration
    |--------------------------------------------------------------------------
    |
    */
    'block' => [
        'items' => [
            [
                'name'     => 'card',
                'template' => 'lsd::block.card',
                'properties' => [
                    [
                        'name' => 'header',
                        'type' => 'string',
                    ],
                    [
                        'name' => 'content',
                        'type' => 'text',
                    ],
                    [
                        'name' => 'link',
                        'type' => 'string',
                    ],
                ],
            ],
        ],
        [
            'name'     => 'alert',
            'template' => 'lsd::block.alert',
            'properties' => [
                [
                    'name' => 'header',
                    'type' => 'string',
                ],
                [
                    'name' => 'content',
                    'type' => 'text',
                ],
                [
                    'name' => 'alert_type',
                    'type' => 'string',
                ],
            ],
        ],
    ],

     /*
    |--------------------------------------------------------------------------
    | Blocks
    |--------------------------------------------------------------------------
    |
    */
    'media_conversions' => [
        'teaser' => [
            'rectangle-lg' => [
                'width'   => 500,
                'height'  => 500,
                'crop'    => 'crop-center',
                'sharpen' => 0,
                'format'  => 'png',
            ],
        ],
    ],
 ];
