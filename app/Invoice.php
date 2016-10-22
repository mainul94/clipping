<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable =['client_id', 'from_address', 'to_address', 'account', 'total_qty', 'subtotal', 'tax', 'totals',
	    'currency', 'paid_amount', 'invoice_date', 'due_date', 'status', 'is_return'];


	public function children()
	{
		return $this->hasMany(InvoiceChild::class);
	}

	/**
	 * Get Client Information
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function client()
	{
		return $this->belongsTo(User::class, 'client_id');
	}
}
