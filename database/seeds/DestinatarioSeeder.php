<?php

use Illuminate\Database\Seeder;
use App\Destinatario;

class DestinatarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Destinatario::class,25)->create([]);
    }
}
