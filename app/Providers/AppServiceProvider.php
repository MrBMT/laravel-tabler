<?php

namespace GusZandy\Tabler\Providers;

use GusZandy\Tabler\Console\Commands\TablerMakeCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
           __DIR__.'/../../config/tabler.php' => config_path('tabler.php'),
       ], 'config');
      $this->loadViewsFrom(__DIR__.'/../../resources/views', 'tabler');
      $this->publishes([
          __DIR__.'/../../resources/views' => resource_path('views/vendor/tabler')
      ], 'views');
      if ($this->app->runningInConsole()) {
         $this->commands([
             TablerMakeCommand::class,
         ]);
      }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->mergeConfigFrom(
          __DIR__.'/../../config/tabler.php', 'tabler'
      );
    }
}
