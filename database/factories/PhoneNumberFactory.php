<?php

/** @var Factory $factory */

use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factory;

$factory->define(PhoneNumber::class, function (Faker\Generator $faker) {
    return [
        'contact_id' => $faker->randomNumber(),
        'title' => $faker->randomElement(['personal', 'work']),
        'phone_number' => $faker->phoneNumber,
    ];
});

$factory->state(PhoneNumber::class, 'persistent', [
    'contact_id' => function () {
        return factory(Contact::class)->create()->getKey();
    },
]);
