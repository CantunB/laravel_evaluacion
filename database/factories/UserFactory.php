<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName(),
        'email' => $faker->unique()->safeEmail,
        'S_Nombre' => $faker->firstName(),
        'S_Apellidos' => $faker->lastName(),
        'S_FotoPerfilUrl' => 'https://source.unsplash.com/random',
        'S_Activo' => $faker->randomElement([User::USUARIO_ACTIVO, User::USUARIO_NO_ACTIVO]),
        'password' => bcrypt('12345'),
        'verified' => $verificado = $faker->randomElement([User::USUARIO_VERIFICADO, User::USUARIO_NO_VERIFICADO]),
        'verification_token' => $verificado == User::USUARIO_VERIFICADO ? null : User::generarVerificationToken(),
    ];
});
