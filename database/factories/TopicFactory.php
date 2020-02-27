<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {

    $createdAt = $faker->dateTimeThisMonth();

    return [
        'title' => $faker->sentence(),
        'body' => $faker->text(),
        'excerpt' => $faker->sentence(),
        'created_at' => $createdAt,
        'updated_at' => $faker->dateTimeThisMonth($createdAt),
    ];
});
