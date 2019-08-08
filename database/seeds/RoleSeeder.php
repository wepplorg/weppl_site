<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Role::insert([
            [
            	'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Admin',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
            	'name' => 'ngo',
                'display_name' => 'NGO',
                'description' => 'NGO',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'name' => 'donor',
                'display_name' => 'Donor',
                'description' => 'Donor',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]
        ]);
    
    }
}
