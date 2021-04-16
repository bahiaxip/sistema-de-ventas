<?php

use Illuminate\Database\Seeder;
use App\Supervisor;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Supervisor::class,22)->create([]);
    }
}
