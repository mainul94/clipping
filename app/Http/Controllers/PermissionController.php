<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use CommonController;


    /**
     * PermissionController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->view_dir = 'admin.permission.';
        $this->model = new Permission();
        $this->permissionCheckSetup($request);
        
    }


    /**
     * @param null $data
     * @return array
     */
    protected function validate_rules($data = null)
    {
        return [
            'name' => 'Required',
            'slug' => 'Required|Unique:roles'.($data && $data->id?',slug,'.$data->id:'')
        ];
    }
}
