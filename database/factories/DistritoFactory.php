<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Distrito;
use Faker\Generator as Faker;

$factory->define(Distrito::class, function (Faker $faker) {
    return [
        'nombre' => $faker->city,
        'region' => App\Region::inRandomOrder()->first()->region,
    ];
});
