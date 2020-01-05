<?php

namespace App\Providers;

use App\Models\Tariffs;
use App\Observers\TariffsObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\UPCalculator;
use App\Observers\UPObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    if ($this->app->environment() !== 'production') {
		    $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
	    }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Schema::defaultStringLength(191);
    	UPCalculator::observe(UPObserver::class);
    	Tariffs::observe(TariffsObserver::class);
    }
}
