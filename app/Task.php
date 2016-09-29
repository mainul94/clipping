<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{

    protected $fillable = ['title','slug','referance','rejected_task_id','client_id','type','instruction','comend',
        'total_qty','total_amount','task_type','status'];

    use CreateUpdateByRecord;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('filterUserType', function (Builder $builder) {
            if (auth()->user() && auth()->user()->type == "Client") {
                $builder->where('client_id',auth()->user()->id);
            }
        });

        /**
         * Get Task Filter status
         *
         */
        static::addGlobalScope('filterTaskStatus', function (Builder $builder) {
            if (request()->get('status')) {
                $builder->where('status',request()->get('status'));
            }
        });

        /**
         * Entry client id on Save Data
         */
        static::saving(function($table)  {
            if (auth()->user()->type == "Client") {
                $table->client_id = auth()->user()->id;
            }
        });
    }

    /**
     * Get Task Status
     * @return array
     */
    public static function status()
    {
        return ['Wating for Review','Accepted','Processing','Rejected','Completed','Finished','Hold'];
    }


    public function setTitleAttribute($data)
    {
        $task = Task::where('slug','like',$data.'%');
        if (empty($this->getAttribute('slug'))) {
            $this->attributes['slug'] = str_slug($data.(count($task)?'-'.count($task):''));
        }
        $this->attributes['title'] = $data;
    }

    /**
     * Set Rejected Task Id Value if null
     * @param $data
     */
    public function setRejectedTaskIdAttribute($data)
    {
        if (empty($data)) {
            $this->attributes['rejected_task_id'] = null;
        }
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
