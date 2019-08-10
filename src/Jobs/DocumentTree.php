<?php

namespace Laramate\StructuredDocument\Jobs;

use Laramate\Nucid\Job\Models\Job;
use Laramate\StructuredDocument\Models\Document;

class DocumentTree extends Job
{
    public function __construct()
    {
    }

    public function handle()
    {
        return Document::with(['children'])->whereNull('parent_id')->get();
    }
}
