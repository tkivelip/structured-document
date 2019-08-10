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
        $layer = Layer::create([
            'title'   => 'Example title',
        ]);

        $this->assertEquals('Example title', $layer->title);
        $this->assertEquals('layer', $layer->structural_type);
    }
}
