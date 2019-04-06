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
        Relation::morphMap([
            'document' => Document::class,
            'layer'    => Layer::class,
            'block'    => Block::class,
        ]);

        BladeX::component([
            str_replace('/', '.', config('document.components.view_path').'/*'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
            $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        }
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/Config.php', 'document');
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
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
}
