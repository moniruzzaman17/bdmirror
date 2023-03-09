<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Help;

class HelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citizen = array();
        $citizen = ['1','1','1','1'];
        
        $email = array();
        $email = ['moon199715@gmail.com','m200305517@cse.jnu.ac.bd','demo.dkkd@gmail.com','moon.coreitechs@gmail.com'];
        
        $mobile = array();
        $mobile = ['01761189963','01761189963','01761189963','01761189963'];
        
        $relation = array();
        $relation = ['Brother','Varsity','Nephew','Cousine'];
        
        for ($i=0; $i < count($citizen); $i++) { 
            Help::create([
                'citizen_id'=> $citizen[$i],
                'email'=> $email[$i],
                'mobile'=> $mobile[$i],
                'relation'=> $relation[$i],
            ]);
        }
    }
}
