<?php

/** @var Factory $factory */

use App\Models\Contact;
use App\Models\Email;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Email::class, function (Faker\Generator $faker) {
    return [
        'contact_id' => $faker->randomNumber(),
        'title' => $faker->randomElement(['personal', 'work']),
        'email' => $faker->safeEmail,
    ];
});

$factory->state(Email::class, 'persistent', [
    'contact_id' => function () {
        return factory(Contact::class)->create()->getKey();
    },
]);
