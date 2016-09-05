<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Role;


class RoleController extends Controller
{

    use CommonController;



    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->view_dir = 'admin.role.';
        $this->middleware('role:administrator|admin');
        $this->model = new Role();
    }


    /**
     * @param null $data
     * @return array
     */
    protected function validate_rules($data = null) {
        return [
            'name' => 'Required',
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
    }


    public function afterUpdate ($model, $request)
    {
        $this->afterSave($model, $request);
    }
}
