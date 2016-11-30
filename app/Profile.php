<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'avatar', 'phone', 'company', 'designation', 'web', 'address', 'country', 'bio'];

	use CreateUpdateByRecord, UploadFiles;


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country()
	{
//		return $this->belongsTo(Country::class);
	}

	public function setAvatarAttribute($data)
	{
		$this->fileUploadOnlyRowAndSetAttribute($data,'avatar','app/public/avatar/');
	}


	public function tasks()
	{
		return $this->user()->taskes;
	}
}
