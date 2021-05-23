<?php

use App\Nacionalidad;
use App\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $region = new Region();
        $region->nombre = 'Sin Especificar';
        $region->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre = 'Paraguaya';
        $nacionalidad->save();
    }
}
