<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$status = new Status;
        $statusnames = array();
        $statusnames = ['Open','In Progress','On Hold','Resolved','Closed','Reopened'];
        
        for ($i=0; $i < count($statusnames); $i++) { 
            Status::create([
                'name'=> $statusnames[$i],
            ]);
        }
    }
}
