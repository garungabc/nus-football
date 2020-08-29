<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'index', 'status', 'slug'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $status = [
        'active' => 1,
        'inactive' => 0,
    ];

    public function getStatusText()
    {
        if ($this->status == self::$status['active'] && empty($this->deleted_at)) {
            return '<p class="text-success">Active</p>';
        } else {
            if (!empty($this->deleted_at)) {
                return '<p class="text-muted">Soft Deleted</p>';
            }
            return '<p class="text-danger">Inactive</p>';
        }
    }
}
