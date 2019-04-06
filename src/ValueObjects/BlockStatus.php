<?php

namespace Laramate\StructuredDocument\ValueObjects;

use mindtwo\LaravelEnumerable\ValueObjects\Enum;

class BlockStatus extends Enum
{
    const Published = 20;
    const Draft = 10;
    const Inactive = 0;
}
