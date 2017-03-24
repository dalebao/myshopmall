<?php


$factory->define(App\Models\Item::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence(mt_rand(3, 10)),
        'description' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'number' => mt_rand('1', '1000'),
        'cost_price' => mt_rand('1', '20'),
        'now_price' => mt_rand('1', '20'),
        'created_at' => $faker->dateTimeBetween('-2 weeks', '+20 days'),
        'updated_at' => $faker->dateTimeBetween('-1 month', '+30 days')
    ];
});