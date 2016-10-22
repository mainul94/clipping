<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceChild extends Model
{
    protected $fillable = ['invoice_id', 'task_id', 'qty', 'uom', 'amount'];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function task()
	{
		return $this->belongsTo(Task::class);
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function invoice()
	{
		return $this->belongsTo(Invoice::class);
	}
}
