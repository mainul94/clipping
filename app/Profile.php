<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'avatar', 'phone', 'designation', 'web', 'address', 'country', 'bio'];

	use CreateUpdateByRecord;


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
		if ($data->isValid()) {
			dd($data);
		}
	}
}
