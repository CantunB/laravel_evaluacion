<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Corporate;
use Faker\Generator as Faker;

$factory->define(Corporate::class, function (Faker $faker) {
    return [
        'S_NombreCorto' => $faker->jobTitle(),
        'S_NombreCompleto' => $faker->company(),
        'S_LogoUrl' => 'https://source.unsplash.com/random',
        'S_DBName' => $faker->domainWord(),
        'S_DBUsuario' => $faker->userName(),
        'S_DBPassword' =>$faker->password(),
        'S_SystemUrl' => $faker->url(),
        'S_Activo' => $faker->randomElement([Corporate::CORPORATIVO_ACTIVO, Corporate::CORPORATIVO_NO_ACTIVO]),
        'D_FechaIncorporacion' => $faker->date(),
        'tw_usuarios_id' => User::all()->random()->id,
        'FK_Asignado_id' => User::all()->random()->id,
    ];

});
