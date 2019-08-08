<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $adminRole = Role::whereName('admin')->first();
        $userRole = Role::whereName('ngo')->first();

        $user = User::create(array(
            'name'    => 'admin',
            //'last_name'     => 'Doe',
            'email'         => 'admin@weppl.com',
            'password'      => Hash::make('password'),
            'remember_token'         => str_random(64),
            
        ));
        $user->attachRole(1);  

        $user = User::create(array(
            'name'    => 'ngo',
            //'last_name'     => 'Doe',
            'email'         => 'ngo@weppl.com',
            'password'      => Hash::make('password'),
            'remember_token'         => str_random(64),
            //'activated'     => true
        ));
        $user->attachRole(2);
    }
}
