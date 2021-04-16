<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	"name"=>"Informática"
        ]);
        Category::create([
        	"name"=>"Muebles"
        ]);
        Category::create([
            "name"=>"Cerámica"
        ]);
        Category::create([
            "name"=>"Bricolaje"
        ]);
    }
}
