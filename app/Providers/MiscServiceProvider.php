<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MiscServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Other\Misc', function($app)
        {
            return new Misc();
        });
    }

    public function provides()
    {
        return array('misc');
    }
}
