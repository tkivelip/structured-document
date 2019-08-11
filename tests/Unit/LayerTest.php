<?php

namespace Laramate\StructuredDocument\Tests\Unit;

use Laramate\StructuredDocument\Models\Layer;
use Laramate\StructuredDocument\Tests\TestCase;

class LayerTest extends TestCase
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
        Layer::create([
            'title'   => 'Example title',
        ]);

        $layer = Layer::first();

        $this->assertEquals('Example title', $layer->title);
        $this->assertEquals('layer', $layer->structural_type);
    }

    public function testRenderLayerWithBlocks()
    {
        $layer = Layer::create([
            'title'     => 'Layer container',
            'item_type' => 'container',
        ]);

        $layer->blocks()->create([
            'title' => 'Card 1',
            'content' => 'This is a card example',
            'item_type' => 'card',
        ]);

        $layer->blocks()->create([
            'title' => 'Card 2',
            'content' => 'This is a card example',
        ]);

        $layer->save();

        $rendered = $layer->render();

        $this->assertEquals('Layer container', $layer->title);
    }
}
