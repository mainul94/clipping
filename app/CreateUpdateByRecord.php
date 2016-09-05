<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/8/16
 * Time: 9:50 PM
 */

namespace App;


trait CreateUpdateByRecord
{

    public static function boot() {
        parent::boot();

        /**
         * Entry Update Date On Save Data
         */
        static::updating(function($table)  {
            $table->updated_by = auth()->user()->id;
        });

        // create a event to happen on deleting
        //        static::deleting(function($table)  {
        //            $table->deleted_by = Auth::user()->username;
        //        });


        /**
         * Entry created by on Save Data
         */
        static::saving(function($table)  {
            $table->created_by = auth()->user()->id;
        });
    }


    /**
     * @return mixed
     * Get Created User Info
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }


    /**
     * @return mixed
     * Get Updated User Info
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}