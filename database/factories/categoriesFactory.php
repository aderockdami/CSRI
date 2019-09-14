<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model\Categories;
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

$factory->define(Categories::class, function (Faker $faker,$name) {
    return [
      'name' => $name,
      'weight' => 50,
      'phase_id' => 6
    ];
});
