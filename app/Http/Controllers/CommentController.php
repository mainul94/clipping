<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{
	use CommonController;

	/**
	 * RoleController constructor.
	 */
	public function __construct(Request $request)
	{
		$this->view_dir = 'admin.comment.';
		$this->model = new Comment();
		$this->permissionCheckSetup($request);
	}


	public function validate_rules(Comment $data = null)
	{
		return [
			'slug' => 'Unique:comments'.($data && $data->id?',slug,'.$data->id:''),
			'comment'=>'required'
		];

	}


}
