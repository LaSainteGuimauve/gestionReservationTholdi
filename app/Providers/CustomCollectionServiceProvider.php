<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;


class CustomCollectionServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Collection::macro('mergeByDesiredKey', function(Collection $collection, $desiredKey) {
            foreach ($this->items as $key => $item) {
                if (is_array($item) && array_key_exists($desiredKey, $item)) {
                    foreach ($collection->all() as $value) {
                        if (is_array($value) && array_key_exists($desiredKey, $value)) {
                            if ($item[$desiredKey] == $value[$desiredKey]) {
                                $this->items[$key] = array_merge($item, $value);
                            }
                        }
                    }
                }
            }
        });        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
