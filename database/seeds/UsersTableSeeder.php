<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $admin = new user;
        $admin->name = 'admin';
        $admin->email ='tejal.sawant@neosofttech.com';
        $admin->password=bcrypt('admin123');
        $admin->created_at=date("Y-m-d H:i:s");
        $admin->save();
    }
}
