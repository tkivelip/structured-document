<?php

namespace Laramate\StructuredDocument\Operations;

use Laramate\Nucid\Operation\Models\Operation;
use Laramate\StructuredDocument\Jobs\DocumentFind;
use Laramate\StructuredDocument\Models\Document;

class DocumentCompose extends Operation
{
    protected $slug;

    public function __construct(string $slug = '')
    {
        $this->slug = $slug;
    }

    public function handle()
    {
        $document = $this->run(DocumentFind::class, ['slug' => $this->slug]) ?? Document::make();

        return view($document->template, ['document' => $document]);
    }
}
