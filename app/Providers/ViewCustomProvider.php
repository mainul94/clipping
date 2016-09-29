<?php

namespace App\Providers;

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as HTML;
use Illuminate\Support\ServiceProvider;

class ViewCustomProvider extends ServiceProvider
{

    use LeftColMenu;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Added menuGenerate Function in Html builder
         */
        HTML::macro('menuGenerator', function ($menus) {
            return ViewCustomProvider::menuGenerator($menus);
        });

        /**
         * Delete Record
         */
        HTML::macro('delete',function ($action,$id, $label = 'Delete',$style='icon',$class='text-danger')
        {
            $form = Form::open(['action' => [$action,$id], 'method' => 'delete', 'id'=>'deleted_form_'.$id, 'style'=>'display:inline']);
            if ($style == 'icon') {
                $form .= "<a href='#' class='confirm $class' data-id=\"deleted_form_$id\"><i class=\"fa fa-trash\"></i></a>";//Form::submit('',['class'=>'btn btn-danger']);
            }else{
                $form .= Form::submit($label,['class'=>'btn btn-danger']);
            }
            return $form.=Form::close();
        });

        view()->composer('admin.role.*', function ($view) {
           return $view->with('permissions', Permission::all());
        });

        view()->composer('admin.user.*', function ($view) {
           return $view->with('roles', Role::all());
        });
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
