<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Trail extends Model
{
	protected $fillable = ['client_id', 'name', 'email', 'phone', 'company', 'title', 'instruction', 'comment',
		'quantity', 'sample_one', 'sample_two', 'sample_three', 'sample_four', 'sample_five', 'status'];

	use UploadFiles;


	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('filterUserType', function (Builder $builder) {
			if (auth()->user() && auth()->user()->type == "Client") {
				$builder->where('client_id',auth()->user()->id);
			}
		});
		/**
		 * Entry client id on Save Data
		 */
		static::saving(function($table)  {
			if (auth()->check() && auth()->user()->type == "Client") {
				$table->client_id = auth()->user()->id;
			}
		});
	}


	public function setSampleOneAttribute($data)
	{
		$this->fileUploadOnlyRowAndSetAttribute($data, 'sample_one');
	}


	public function setSampleTwoAttribute($data)
	{
		$this->fileUploadOnlyRowAndSetAttribute($data, 'sample_two');
	}


	public function setSampleThreeAttribute($data)
	{
		$this->fileUploadOnlyRowAndSetAttribute($data, 'sample_three');
	}


	public function setSampleFourAttribute($data)
	{
		$this->fileUploadOnlyRowAndSetAttribute($data, 'sample_four');
	}


	public function setSampleFiveAttribute($data)
	{
		$this->fileUploadOnlyRowAndSetAttribute($data, 'sample_five');
	}
}
