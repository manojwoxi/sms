<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Role::where('name', 'admin')->first();
        DB::table('users')->insert([
            'fname' => 'sagar',
            'lname' => 'acharya',
            'email'=>'admin@gmail.com',
            'username'=>'admin',
            'password'=>bcrypt('admin'),
            'phone_no' =>'9762846214',
            'birthdate' =>'1993-05-31',
            'is_active'=>1,
            'status_id'=>1,
            'role_id'=> $role->id,
            'remember_token'=> 'wAYH8YjEJoksLkfBQW9m1ECaxRr5HNUTX4PkehMV',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
