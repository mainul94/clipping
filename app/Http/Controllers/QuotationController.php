<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuotationController extends Controller
{
	use CommonController;


	public function __construct(Request $request)
	{
		$this->view_dir = 'admin.quotation.';
		$this->model = new Quotation();
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
