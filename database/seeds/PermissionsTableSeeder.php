<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('permissions')->insert([
           [
               'name' => 'create',
               'slug' => 'create',
               'description' => 'Add Data'
           ],
           [
                'name' => 'edit',
                'slug' => 'edit',
                'description' => 'edit Data'
           ],
           [
                'name' => 'view',
                'slug' => 'view',
                'description' => 'view Data'
           ],
           [
                'name' => 'delete',
                'slug' => 'delete',
                'description' => 'delete Data'
            ]   
       ]);
    }
}
