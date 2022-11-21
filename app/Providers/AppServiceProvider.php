<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        include_once base_path('config-propel/propel.config.php');
    }

}
