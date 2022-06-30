<?php

namespace Wdelfuego\NovaListCard;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

use App\Nova\DataSources\DataSourceController;

class CardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-list-card', __DIR__.'/../dist/js/card.js');
            Nova::style('nova-list-card', __DIR__.'/../dist/css/card.css');
        });
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/nova-list-card')
                ->group(__DIR__.'/../routes/api.php');
    }

    public function register()
    {

    }
}
