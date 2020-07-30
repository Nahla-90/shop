<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Acl;

class AclTableSeeder extends Seeder
{

    public function run()
    {
        Acl::create(array(
            'resource' => 'ProductController@index',
            'role' => 'ROLE_ADMIN'
        ));
        Acl::create(array(
            'resource' => 'ProductController@show',
            'role' => 'ROLE_ADMIN'
        ));
        Acl::create(array(
            'resource' => 'ProductController@store',
            'role' => 'ROLE_ADMIN'
        ));
        Acl::create(array(
            'resource' => 'ProductController@create',
            'role' => 'ROLE_ADMIN'
        ));
        Acl::create(array(
            'resource' => 'ProductController@destroy',
            'role' => 'ROLE_ADMIN'
        ));
        Acl::create(array(
            'resource' => 'ProductController@edit',
            'role' => 'ROLE_ADMIN'
        ));
        Acl::create(array(
            'resource' => 'ProductController@imageUploadPost',
            'role' => 'ROLE_ADMIN'
        ));


        Acl::create(array(
            'resource' => 'ProductController@index',
            'role' => 'ROLE_USER'
        ));
        Acl::create(array(
            'resource' => 'ProductController@show',
            'role' => 'ROLE_USER'
        ));
    }
}
