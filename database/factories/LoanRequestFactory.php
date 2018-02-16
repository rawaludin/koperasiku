<?php

use Faker\Generator as Faker;

$factory->define(App\LoanRequest::class, function (Faker $faker) {
    return [
        'amount' => rand(3,100) * 1000000,
        'duration' => rand(6,24),
        'is_submitted' => 0,
        'is_approved' => null,
        'member_id' => rand(1,2),
        'admin_id' => null,
    ];
});
