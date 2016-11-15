<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/6/16
 * Time: 7:51 PM
 */

namespace App;


trait HasComment
{
	protected $parent_type = null;


	/**
	 * All Comments
	 * @return mixed
	 */

	public function comments()
	{
		return $this->hasMany(Comment::class,'parent')->where('parent_type', $this->parent_type)->whereNull('comment_id');
	}

	/**
	 * All Child Comments
	 * @return mixed
	 */

	public function childrenComments()
	{
		return $this->hasMany(Comment::class);
	}

}