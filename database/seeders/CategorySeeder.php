<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$category = new Category;
        $categorynames = array();
        $categorynames = ['Road','Bridge','Transport','Water Supply','Electricity Supply','Waste Management','Human Rights','Law Enforcement','Public Health','Municipal Administration','Social Welfare','Economic Development'];
        
        for ($i=0; $i < count($categorynames); $i++) { 
            Category::create([
                'name'=> $categorynames[$i],
            ]);
        }
    }
}
