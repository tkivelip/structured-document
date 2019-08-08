<?php

namespace Laramate\StructuredDocument\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laramate\StructuredDocument\Helpers\Lsd;
use Laramate\StructuredDocument\Interfaces\StructuralItem;
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

        AliasLoader::getInstance()->alias('Lsd', Lsd::class);
    }
        
    /**
     * Create morph maps for the structured document models
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
            __DIR__ . '/../Config/Config.php' => config_path('document.php'),
        ], 'laramate-structured-document-config');

        $this->publishes(
            [__DIR__ . '/../Migrations' => database_path('migrations')],
            'laramate-structured-document-migrations'
        );
    }
    
    protected function bootViews() 
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'lsd');

        Blade::directive('extract', function ($expression) {
            return "<?php extract($expression); ?>";
        });
    }
    
    /**
     * Boot BladeX
     */
    protected function bootBladeX() 
    {
        //BladeX::prefix('x');

        BladeX::component([
            'lsd::block.*',
            'lsd::layer.*',
            'lsd::navigation.*',
            'lsd::render.*',
        ]);


    }
}
