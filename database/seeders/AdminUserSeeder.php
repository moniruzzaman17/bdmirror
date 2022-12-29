<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// create object of admin user model
    	$admin = new Admin;

    	$admin->name = 'Md. Moniruzzaman';
    	$admin->email = 'moon.mn717@gmail.com';
    	$admin->password = Hash::make('bdmirror2022');
    	$admin->save();
    }
}
