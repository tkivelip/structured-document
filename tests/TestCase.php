<?php

namespace Laramate\StructuredDocument\Tests;

use Laramate\FlexProperties\Providers\FlexPropertyServiceProvider;
use Laramate\StructuredDocument\Providers\DocumentServiceProvider;
use Orchestra\Testbench\TestCase as BaseTest;
use Spatie\BladeX\BladeXServiceProvider;

abstract class TestCase extends BaseTest
{
    protected function getPackageProviders($app)
    {
        return [
            FlexPropertyServiceProvider::class,
            BladeXServiceProvider::class,
            DocumentServiceProvider::class
        ];
    }
}
