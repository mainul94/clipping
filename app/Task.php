<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{

    protected $fillable = ['title','slug','referance','rejected_task_id','client_id','type','instruction','comend',
        'total_qty','total_amount','task_type','status', 'delivery', 'ftp_id'];

    use HasComment, Notifiable;

    protected $dates = ['delivery'];

    public static function boot()
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
            if (auth()->user()->type == "Client") {
                $table->client_id = auth()->user()->id;
            }
            $table->created_by = auth()->user()->id;
        });

        /**
         * Entry Update Date On Save Data
         */
        static::updating(function($table)  {
            $table->updated_by = auth()->user()->id;
        });
    }

    /**
     * Task constructor.
     * @param array $attributes
     */

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->parent_type = class_basename($this);

    }

    protected $attributes = ['storage'=>'local'];

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
        $task = Task::where('slug','like',str_slug($data).'%')->withoutGlobalScope('filterUserType')->count();
        if (empty($this->getAttribute('slug'))) {
            $this->attributes['slug'] = str_slug($data.($task?'-'.$task:''));
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


    public static function filtersOptions()
    {
        return [
            "status" => [
                "filed_name" => "status",
                "filed_type" => "select",
                "field_options" => self::status(),
                "default" => "Processing"
            ],
            "title" => [
                "filed_name" => "title",
                "filed_type" => "data",
                "field_options" => null
            ],
            "delivery_date" => [
                "filed_name" => "delivery_date",
                "filed_type" => "date",
                "field_options" => null
            ]
        ];
    }


    /**
     * @param $data
     */
    /*public function setTotalAmountAttribute($data)
    {
        if (empty($data)) {
            $this->attributes['total_amount'] = 0;
        }
    }*/


    public function scopePending($query)
    {
        return $query->where('status', 'Wating for Review')->get();
    }


    public function scopeAccepted($query)
    {
        return $query->where('status', 'Accepted')->get();
    }


    public function scopeRejected($query)
    {
        return $query->where('status', 'Rejected')->get();
    }


    public function scopeHold($query)
    {
        return $query->where('status', 'Hold')->get();
    }


    public function scopeProcessing($query)
    {
        return $query->where('status', 'Processing')->get();
    }


    public function scopeCompleted($query)
    {
        return $query->where('status', 'Completed')->get();
    }


    public function scopeFinished($query)
    {
        return $query->where('status', 'Finished')->get();
    }

    public function ftp()
    {
        return $this->belongsTo(Ftp::class);
    }

    public function getFtpAttribute()
    {
        if ( ! array_key_exists('ftp', $this->relations)) $this->load('ftp');

        $ftp = ($this->getRelation('ftp')) ?$this->getRelation('ftp')->toArray(): $this->defaultFTP();

        return $ftp;
    }


    public function defaultFTP()
    {
        return config('filesystems.disks.ftp');
    }

    public function setFtpIdAttribute($value)
    {
        if ($value == 'Default') {
            $value = null;
        }
        $this->attributes['ftp_id'] = $value;
    }
}
