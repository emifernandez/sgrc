<?php

use App\Distrito;
use App\Region;
use Illuminate\Database\Seeder;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distrito = new Distrito();
        $distrito->nombre = 'Sin Especificar';
        $distrito->region = Region::all()->first()->region;
        $distrito->save();
    }
}
