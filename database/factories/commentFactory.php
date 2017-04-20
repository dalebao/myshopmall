<?php

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {

    return [
        'user_id' => mt_rand(1,51),
        'is_anonymous' => mt_rand(0,1),
        'item_id' => mt_rand(1,60),
        'score' => mt_rand(3, 5),
        'nickname'=> $faker->name,
        'comment' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'created_at' => $faker->dateTimeBetween('-2 weeks', '+20 days'),
        'updated_at' => $faker->dateTimeBetween('-1 month', '+30 days')
    ];
});