<?php

namespace App\Providers;

use App\Setting;
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
        HTML::macro('taskStatusLabel',function ($status)
        {
            switch ($status) {
                case "Wating for Review":
                    return "<span class='label label-warning'>".$status."</span>";
                case "Accepted":
                    return "<span class='label label-info'>".$status."</span>";
                case "Processing":
                    return "<span class='label label-primary'>".$status."</span>";
                case "Rejected":
                    return "<span class='label label-danger'>".$status."</span>";
                case "Completed":
                    return "<span class='label label-success'>".$status."</span>";
                case "Finished":
                    return "<span class='label label-success'>".$status."</span>";
                case "Hold":
                    return "<span class='label label-warning'>".$status."</span>";
                default :
                    return "<span class='label label-default'>".$status."</span>";
            }
        });

        view()->composer('admin.role.*', function ($view) {
           return $view->with('permissions', Permission::all());
        });

        view()->composer('admin.user.*', function ($view) {
           return $view->with('roles', Role::all());
        });

        view()->composer('admin.*', function ($view) {
           return $view->with('setting', new Setting());
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
