<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
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

    protected $appends = ['permissions'];

    /**
     * Created By Nahla Sameh
     * Get permissions allowed to current user
     * @return array
     */
    public function getPermissionsAttribute()
    {
        /* Get resources from acl table using current user role */
        $acls = Acl::where('role', Auth::user()->role)->get();

        $permissions = [];
        foreach ($acls as $acl) {
            $permissions[] = $acl->resource;
        }
        return $permissions;
    }
}
