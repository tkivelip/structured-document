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
     * @test
     */
    public function testRenderEmptyBlock()
    {
        $block = new Block();
        $rendered = $block->render();

        $this->assertEquals('lsd::block.block', $block->template);
        $this->assertNotEmpty($rendered);
    }

    /**
     * Example test.
     *
     * @test
     */
    public function testCreateBlock()
    {
        Block::create([
            'title'   => 'Example title',
            'content' => 'Example content',
        ]);

        $block = Block::first();

        $this->assertEquals('Example title', $block->title);
        $this->assertEquals('Example content', $block->content);
        $this->assertEquals('block', $block->structural_type);
        $this->assertEquals('lsd::block.block', $block->template);
    }

    /**
     * Render block test.
     *
     * @throws \Throwable
     *
     * @test
     */
    public function testMakeRenderBlock()
    {
        $block = Block::make([
            'title'   => 'Example title',
            'content' => 'Example content',
        ]);

        $renderedBlock = $block->render();

        $this->assertEquals('lsd::block.block', $block->template);
        $this->assertStringContainsString('Example title', $renderedBlock);
        $this->assertStringContainsString('Example content', $renderedBlock);
    }

    /**
     * Render block test.
     *
     * @test
     */
    public function testMakeRenderBlockCard()
    {
        $block = Block::make([
            'content' => 'Example content',
            'item_type'    => 'card',
        ]);

        $renderedBlock = $block->render();

        $this->assertEquals('lsd::block.card', $block->template);
        $this->assertEquals('card', $block->item_type);
        $this->assertStringContainsString('class="card', $renderedBlock);
        $this->assertStringContainsString('Example content', $renderedBlock);
    }
}
