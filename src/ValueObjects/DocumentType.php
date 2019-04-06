<?php

namespace Laramate\StructuredDocument\ValueObjects;

use mindtwo\LaravelEnumerable\ValueObjects\Enum;

class DocumentType extends Enum
{
    const Content = 'content';
    const Reference = 'reference';
    const Root = 'root';
}
