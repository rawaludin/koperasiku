<?php

use Faker\Generator as Faker;

$factory->define(App\Loan::class, function (Faker $faker) {
    return [
        'member_id' => rand(1,3),
        'admin_id' => rand(1,3),
        'duration' => $faker->randomElement([6,12,18,24,36]),
        'is_completed' => $faker->boolean,
        'monthly_amount' => rand(1,100) * 1000000,
        'total_paid' => rand(1,100) * 1000000,
        'total_amount' => rand(1,100) * 1000000,
    ];
});
