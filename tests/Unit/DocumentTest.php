<?php

namespace Laramate\StructuredDocument\Tests\Unit;

use Laramate\StructuredDocument\Models\Block;
use Laramate\StructuredDocument\Models\Document;
use Laramate\StructuredDocument\Tests\TestCase;

class DocumentTest extends TestCase
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
    public function testCreateDocument()
    {
        $document = Document::create([
            'title'   => 'Example title',
        ]);

        $this->assertEquals('Example title', $document->title);
        $this->assertEquals('document', $document->structural_type);
    }
}
