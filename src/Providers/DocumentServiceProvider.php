<?php

namespace Laramate\StructuredDocument\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Laramate\StructuredDocument\Facades\Lsd;
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
        $this->bootMorphMap();
        $this->bootViews();
        $this->bootBladeX();
        $this->bootConsole();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerAliases();
        $this->registerConfig();
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/Config.php', 'lsd');
    }

    public function registerAliases()
    {
        AliasLoader::getInstance()->alias('Lsd', Lsd::class);
    }

    /**
     * Create morph maps for the structured document models.
     */
    protected function bootMorphMap()
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
            __DIR__.'/../Config/Config.php' => config_path('document.php'),
        ], 'laramate-structured-document-config');

        $this->publishes(
            [__DIR__.'/../Migrations' => database_path('migrations')],
            'laramate-structured-document-migrations'
        );
    }

    protected function bootViews()
    {
        $framework = Config::get('lsd.view_framework');
        $this->loadViewsFrom(__DIR__.'/../Views/'.$framework, 'lsd');

        Blade::directive('extract', function ($expression) {
            return "<?php extract($expression); ?>";
        });
    }

    /**
     * Boot BladeX.
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

    protected function bootConsole()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
            $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        }
    }
}
