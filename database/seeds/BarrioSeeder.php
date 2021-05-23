<?php

use App\Barrio;
use App\Distrito;
use Illuminate\Database\Seeder;

class BarrioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barrio = new Barrio();
        $barrio->nombre = 'Sin Especificar';
        $barrio->distrito = Distrito::all()->first()->distrito;
        $barrio->save();
    }
}
