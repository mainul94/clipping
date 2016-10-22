<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceChild extends Model
{
    protected $fillable = ['invoice_id', 'task_id', 'qty', 'uom', 'amount'];


	public function task()
	{
		return $this->belongsTo(Task::class);
	}
}
