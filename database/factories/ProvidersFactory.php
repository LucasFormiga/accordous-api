<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provider;
use App\User;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'name' => $faker->name,
        'email' => $faker->email,
        'payment' => $faker->numerify('###.##'),
    ];
});
