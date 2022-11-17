<?php

namespace Mlk\Home\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    # register() is always rendered earlier than boot() :
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/' , 'Home');
        Route::middleware('web')->namespace('Mlk\Home\Http\Controllers')->group(__DIR__ . '/../Routes/home_routes.php');
    }
    public function boot()
    {
    }
}
