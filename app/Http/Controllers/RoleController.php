<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{

    use CommonController;



    /**
     * RoleController constructor.
     */
    public function __construct(Request $request)
    {
        $this->view_dir = 'admin.role.';
        $this->model = new Role();
        $this->permissionCheckSetup($request);
    }


    /**
     * @param null $data
     * @return array
     */
    protected function validate_rules($data = null) {
        return [
            'name' => 'Required',
            'level' => 'Required',
            'slug' => 'Required|Unique:roles'.($data && $data->id?',slug,'.$data->id:'')
        ];
    }


    /**
     * @param Role $model
     * @param $request
     */
    public function afterSave($model, $request)
    {
        $model->permissions()->sync($request->get('permission_id')?$request->get('permission_id'):[]);
        /*foreach ($model->users as $user){
            $user->permissions()->sync($request->get('permission_id')?$request->get('permission_id'):[]);
        }*/
    }


    public function afterUpdate ($model, $request)
    {
        $this->afterSave($model, $request);
    }
}
