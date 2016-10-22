<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Comment;
use App\Country;
use App\Division;
use App\Invoice;
use App\Media;
use App\Page;
use App\Quotation;
use App\Region;
use App\Setting;
use App\Slide;
use App\Task;
use App\Trail;
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
        $router->model('setting', Setting::class);
        $router->model('task', Task::class);
        $router->model('quotation', Quotation::class);
        $router->model('trail', Trail::class);
        $router->model('comment', Comment::class);
        $router->model('invoice', Invoice::class);
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
