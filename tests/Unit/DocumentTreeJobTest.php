<?php

namespace Laramate\StructuredDocument\Tests\Unit;

use Laramate\Nucid\Job\Facades\Job;
use Laramate\StructuredDocument\Jobs\DocumentTree;
use Laramate\StructuredDocument\Models\Block;
use Laramate\StructuredDocument\Models\Document;
use Laramate\StructuredDocument\Tests\TestCase;

class DocumentTreeJobTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../../src/Migrations');
        $this->loadMigrationsFrom(__DIR__.'/../../vendor/laramate/flex-properties/src/Migrations');
    }

    /**
     * Example test.
     *
     * @test
     */
    public function testCreateBlock()
    {
        $document = Document::create([
            'title'   => 'Document layer 1',
        ]);

        $document2 = Document::create([
            'title'   => 'Document layer 2',
            'parent_id'   => $document->id,
        ]);

        $document3 = Document::create([
            'title'   => 'Document 2 layer 2',
            'parent_id'   => $document->id,
        ]);

        $tree = Job::run(DocumentTree::class);

        $this->assertCount(1, $tree);
        $this->assertCount(2, $tree->first()->children);
    }
}
