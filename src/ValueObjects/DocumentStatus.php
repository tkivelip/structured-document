<?php

namespace Laramate\StructuredDocument\ValueObjects;

use mindtwo\LaravelEnumerable\ValueObjects\Enum;

class DocumentStatus extends Enum
{
    const Active = 1;
    const Inactive = 0;
}
