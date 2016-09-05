<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'company', 'title', 'instruction', 'comment', 'quantity', 'sample_one',
		'sample_two', 'sample_three', 'sample_four', 'sample_five', 'status'];


}
