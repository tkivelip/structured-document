<?php

namespace Laramate\StructuredDocument\ValueObjects;

use mindtwo\LaravelEnumerable\ValueObjects\Enum;

class BlockType extends Enum
{
    const Content = 'content';
    const Container = 'container';
    const Layer = 'layer';
    const Reference = 'reference';
}
