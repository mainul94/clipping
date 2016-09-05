<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    use CommonController;

    public function __construct()
    {
        $this->view_dir = 'admin.user.';
        $this->middleware('role:administrator|admin');
        $this->model = new User();
    }

    protected  $old_password = null;
    protected function validate_rules($data)
    {
        if (!empty($data)) {
            $this->old_password = $data->makeVisible('password')->password;
        }
        return [
            'name' => 'Required',
            'email' => 'Email|Unique:users'.($data && $data->id?',email,'.$data->id:''),
            'password' => 'Confirmed|Min:6|Max:32'.(empty($data)?'|Required':'')
        ];
    }


    public function afterSave($model, $request)
    {
        if ($request->get('password')) {
            $model->fill(['password'=>bcrypt($request->get('password'))]);
        }else {
            $model->fill(['password'=>$this->old_password]);
        }
        $model->save();

        $model->roles()->sync($request->get('role_id')?$request->get('role_id'):[]);
    }


    public function afterUpdate($model, $request)
    {
        $this->afterSave($model, $request);
    }
    
}
