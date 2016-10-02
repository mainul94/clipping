<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
	protected $fillable = ['name', 'email', 'phone', 'company', 'title', 'instruction', 'comment', 'quantity', 'sample_one',
		'sample_two', 'sample_three', 'sample_four', 'sample_five', 'status'];

	use UploadFiles;


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
