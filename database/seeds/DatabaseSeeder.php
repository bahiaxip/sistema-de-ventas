<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        //el seeder Supervisor se crea en el VendedorFactory,
        //debido a la relación de tablas, las migraciones supervisores
        //y vendedores están asociadas, vendedor requiere un id de 
        //de supervisor
        //$this->call(SupervisorSeeder::class);
        $this->call(VendedorSeeder::class);
        $this->call(DestinatarioSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(DataSeeder::class);
    }
}
