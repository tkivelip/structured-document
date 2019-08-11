<?php

namespace Laramate\StructuredDocument\Facades;

use Laramate\FacadeMapper\Facades\Facade;
use Laramate\StructuredDocument\Models\Helpers\LsdHelper;

class Lsd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return LsdHelper::class;
    }
}