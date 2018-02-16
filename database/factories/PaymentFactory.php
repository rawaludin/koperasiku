<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'loan_id' => rand(1,3),
        'admin_id' => rand(1,3),
    ];
});
