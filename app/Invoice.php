<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Invoice extends Model
{
    protected $fillable =['client_id', 'from_address', 'to_address', 'account', 'total_qty', 'subtotal', 'tax', 'totals',
	    'currency', 'paid_amount', 'invoice_date', 'due_date', 'status', 'is_return'];


	/**
	 * @var array
	 */
	protected $dates = ['invoice_date', 'due_date'];


	/**
	 *
	 */
	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('isClient', function (Builder $builder) {
			if (auth()->user() && auth()->user()->type == "Client") {
				$builder->where('client_id', auth()->user()->id);
			}
		});
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
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
