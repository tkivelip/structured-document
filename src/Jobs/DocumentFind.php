<?php

namespace Laramate\StructuredDocument\Jobs;

use Laramate\StructuredDocument\Models\Document;
use Laramate\Nucid\Job\Exceptions\Exception;
use Laramate\Nucid\Job\Models\Job;

class DocumentFind extends Job
{
    protected $id;
    protected $uuid;
    protected $slug;

    public function __construct(int $id = 0, string $uuid = '', string $slug = '')
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->slug = $slug;
    }

    public function handle()
    {
        $document = Document::with(['blocks']);

        if (! empty($this->id)) {
            return $document->find($this->id);
        }

        if (! empty($this->uuid)) {
            return $document->where('uuid', $this->uuid)->first();
        }

        if (! empty($this->slug)) {
            return $document->where('slug', $this->slug)->first();
        }

        throw new Exception('Either id, uuid or slug must be set!');
    }
}
