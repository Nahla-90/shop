<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Acl extends Model
{
    protected $fillable = ['resource', 'role'];

    /*public static function getChoices()
    {
        return [
            'permissions' => self::CHOICE_PERMISSIONS,
        ];
    }

    public static function grantedRoles(string $resource)
    {
        $roles = [];
        foreach (self::CHOICE_PERMISSIONS as $key => $val) {
            in_array($resource, $val) ? $roles[] = $key : false;
        }

        return $roles;
    }

    public static function isAuthorized(string $role, string $resource)
    {
        return in_array($role, self::grantedRoles($resource));
    }*/
}
