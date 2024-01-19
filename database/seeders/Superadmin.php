<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class Superadmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::create([
            'username' => 'SuperAdmin', 
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin')
        ]);
    }
}
