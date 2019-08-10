<?php

namespace Laramate\StructuredDocument\Tests\Unit;

use Laramate\StructuredDocument\Models\Block;
use Laramate\StructuredDocument\Tests\TestCase;

class BlockTest extends TestCase
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
        $block = Block::create([
            'title'   => 'Example title',
            'content' => 'Example content',
        ]);

        $this->assertEquals('Example title', $block->title);
        $this->assertEquals('Example content', $block->content);
    }
}
