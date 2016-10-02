<?php

namespace App\Http\Controllers;

use App\Trail;
use Illuminate\Http\Request;

use App\Http\Requests;

class TrailController extends Controller
{
	use CommonController;


	public function __construct(Request $request)
	{
		$this->view_dir = 'admin.trail.';
		$this->model = new Trail();
//		$this->permissionCheckSetup($request);

	}



	/**
	 * @param null $data
	 */
	protected function validate_rules($data = null)
	{
		return [
			'name' => 'Required',
			'email' => 'Required',
			'quantity' => 'Required'
		];
	}
}
