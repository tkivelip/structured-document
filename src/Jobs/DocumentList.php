<?php

namespace Laramate\StructuredDocument\Jobs;

use Laramate\StructuredDocument\Models\Document;
use Laramate\Nucid\Job\Models\Job;

class DocumentList extends Job
{
    public function __construct()
    {
    }

    public function handle()
    {
        return Document::get();
    }
}
