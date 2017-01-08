<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Ftp extends Model
{
    protected $fillable = ['user_id', 'driver', 'title', 'host', 'username', 'password', 'port', 'root', 'passive', 'ssl',
	    'timeout', 'status'];

	use CreateUpdateByRecord;

	public static function boot()
	{
		parent::boot();

		static::addGlobalScope(new StatusScope);

	}


	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
