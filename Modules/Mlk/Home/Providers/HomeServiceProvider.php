<?php

namespace Mlk\Home\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mlk\Comment\Repositories\CommentRepo;
use Mlk\Category\Repositories\CategoryRepo;


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
        # When Repeat One Specific Query Repeated => Use From view()->composer() => Access AnyWhere!!!
        view()->composer(['Home::section.footer', 'Home::section.header','Category::Home.details'], static function ($view) {
            $categoryRepo = new CategoryRepo;
            $categories = $categoryRepo->getActiveCategories()->get(); #  Show Categories In Footer And Header

            $view->with(['categories' => $categories]);
        });
        # Comments
         view()->composer(['Home::parts.sidebar_left'], static function ($view) {
            $categoryRepo = new CommentRepo;
            $latestComments = $categoryRepo->getLatestComments()->limit(4)->get();

            $view->with(['latestComments' => $latestComments]);
        });

        $this->app->booted(static function () {
            config()->set('panelConfig.menus.home', [
                'url'   => route('home.index'),
                'title' => 'صفحه اصلی ',
                'icon'  => 'home',
            ]);
        });
    }
}



