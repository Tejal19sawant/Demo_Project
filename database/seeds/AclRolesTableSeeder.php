<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Kodeine\Acl\Models\Eloquent\Role;


class AclRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      

       DB::table('roles')->insert([
           [
                'name' => 'superadmin',
                'slug' => 'superadmin',
                'description' => 'manage administration privileges'
           ],
           [
               'name' => 'admin',
               'slug' => 'admin',
               'description' => 'manage administration privileges'
           ],
           [
                'name' => 'inventory manager',
                'slug' => 'inventory manager',
                'description' => 'inventory manager privileges'
           ],
           [
                'name' => 'order manager',
                'slug' => 'order manager',
                'description' => 'order manager privileges'
           ],
           [
                'name' => 'customer',
                'slug' => 'customer',
                'description' => 'customer privileges'
           ]

       ]);

      

    }
}
