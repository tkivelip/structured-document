<?php

namespace Laramate\StructuredDocument\ValueObjects;

use mindtwo\LaravelEnumerable\ValueObjects\Enum;

class ContentType extends Enum
{
    const SimpleHtml = 'simple_html';
    const Html = 'html';
    const Markdown = 'markdown';
    const Binary = 'binary';
}
