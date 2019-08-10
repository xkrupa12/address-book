<?php

/** @var Factory $factory */

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Contact::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'note' => $faker->paragraph,
    ];
});
