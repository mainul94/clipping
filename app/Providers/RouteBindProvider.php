<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Country;
use App\Division;
use App\Media;
use App\Page;
use App\Region;
use App\Setting;
use App\Slide;
use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteBindProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->model('role', Role::class);
        $router->model('permission', Permission::class);
        $router->model('user', User::class);
        $router->model('region', Region::class);
        $router->model('country', Country::class);
        $router->model('division', Division::class);
        $router->model('page', Page::class);
        $router->model('category', Category::class);
        $router->model('article', Article::class);
        $router->model('slide', Slide::class);
        $router->model('setting', Setting::class);
        $router->model('media', Media::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
