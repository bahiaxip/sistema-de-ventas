<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("data")->insert([
        	"name"=>"IVA",
        	"data"=>"21"
        ]);
        DB::table("data")->insert([
        	"name"=>"DESIGN_INDEX",
        	"data"=>"BUTTONS"
        ]);

    }
}
