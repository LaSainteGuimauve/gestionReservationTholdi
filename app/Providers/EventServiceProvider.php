<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {
        parent::boot();

        Event::listen('kernel.handled', function($f) {
            dd($f);
//            if ($routeMatched->route->uri != '/' &&
//                    $routeMatched->route->uri != 'AuthentificationCompteUtilisateur' 
//                    ) {
//                        dd($routeMatched);
//            }
        });
    }

    public function register() {
        parent::register();
        //$this->app->bind('App\Providers\EventServiceProvider', $this->app->make('request'));
    }

}
