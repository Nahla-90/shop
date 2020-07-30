<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        User::create(array(
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'role'=>'ROLE_ADMIN',
            'password' => Hash::make('password'),
        ));
    }

}
