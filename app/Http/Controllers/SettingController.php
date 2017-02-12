<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;

class SettingController extends Controller
{
    use CommonController;

    /**
     * RoleController constructor.
     */
    public function __construct(Request $request)
    {
        $this->permission['index'] = 'update';
        $this->view_dir = 'admin.setting.';
        $this->model = new Setting();
        $this->permissionCheckSetup($request);
    }

    /**
     * @param Setting|null $data
     * @return array
     */
    public function validate_rules(Setting $data = null)
    {
        return [
            'name'=> 'Required|Unique:settings'.($data && $data->id ? ',name,'. $data->id:'')
        ];

    }
}
