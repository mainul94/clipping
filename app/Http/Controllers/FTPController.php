<?php

namespace App\Http\Controllers;

use App\Ftp;
use Illuminate\Http\Request;

class FTPController extends Controller
{
	use CommonController;

	/**
	 * RoleController constructor.
	 */
	public function __construct(Request $request)
	{
		$this->view_dir = 'admin.ftp.';
		$this->model = new Ftp();
		$this->permissionCheckSetup($request);
	}


	public function validate_rules(Ftp $data = null)
	{
		return [
			'host'=>'required',
			'username'=>'required',
            'password' => 'Confirmed|Min:6|Max:32'.(empty($data)?'|Required':'')
		];

	}
}
