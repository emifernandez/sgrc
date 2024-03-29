<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(BarrioSeeder::class);
        $this->call(AccesoSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}
