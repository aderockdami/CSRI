<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        'email'=>'admin',
        'sector'=>'admin',
        'date_of_assesment'=>'2019/12/12',
        'internal_external'=>'internal',
        'password'=>'$2y$10$zPftnpIFyB.U7oxf1zRi0.sr2TuSykuDxKDbNKBWg86mnODshCN.e',
        'user_type'=>'admin'
    ];
});
