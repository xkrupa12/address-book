<?php

/** @var Factory $factory */

use App\Models\Address;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Address::class, function (Faker\Generator $faker) {
    return [
        'contact_id' => $faker->randomNumber(),
        'title' => $faker->randomElement(['home', 'office', 'school', 'work', 'cabin', 'pub']),
        'street' => $faker->streetName,
        'street_number' => $faker->randomNumber(),
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'country' => $faker->country,
    ];
});

$factory->state(Address::class, 'persistent', [
    'contact_id' => function () {
        return factory(Contact::class)->create()->getKey();
    },
]);
