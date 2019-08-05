<?php

namespace Laramate\StructuredDocument\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laramate\StructuredDocument\Models\Block;
use Laramate\StructuredDocument\Models\Document;
use Laramate\StructuredDocument\Models\Layer;
use Spatie\BladeX\Facades\BladeX;

class DocumentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->createMorphMap();
        $this->bootBladeX();

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
            $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/Config.php', 'document');
    }
    
    /**
     * Boot BladeX
     */
    protected function bootBladeX() 
    {
        BladeX::component([
            'lsd::block.*',
            'lsd::layer.*',
            'lsd::navigation.*',
            'lsd::render.*',
        ]);
    }
    
    /**
     * Create morph maps for the structured document models
     */
    protected function createMorphMap() 
    {
        Relation::morphMap([
            'document' => Document::class,
            'layer'    => Layer::class,
            'block'    => Block::class,
        ]);
    }

    /**
     * Register the package's publishable resources.
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../Config/Config.php' => config_path('document.php'),
        ], 'laramate-structured-document-config');

        $this->publishes(
            [__DIR__ . '/../Migrations' => database_path('migrations')],
            'laramate-structured-document-migrations'
        );
    }
    
    protected function registerViews() 
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'lsd');
    }
}
