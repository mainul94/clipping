<?php

namespace App;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use CanResetPassword, HasRoleAndPermission, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get User Assigned Roles
     * @return mixed
     */
    public function getRoleIdAttribute()
    {
        return $this->roles()->pluck('role_id')->all();
    }


    /**
     * Get user Profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function tasks()
    {
        $tasks = $this->belongsToMany(Taks::class);
        if (auth()->user()->type === 'Client') {
            return $tasks->where('client_id', auth()->user()->id);
        }
        return $tasks;
    }


    public function pendingTasks()
    {
        return $this->tasks()->where('status', 'Wating for Review');
    }

}
