<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Tariffs;
use Faker\Generator as Faker;


$factory->define(Tariffs::class, function (Faker $faker) {

	$createdAt = $faker->dateTimeBetween('-13 months', '-1 months');

	$data = [
		'user_id' => rand(1, 6),
		'elect_before' => strval(rand(0, 1) + rand(1, 100)/100),
		'elect_under' => strval(rand(1, 2) + rand(1, 100)/100),
		'gaz_t' => strval(rand(8, 12) + rand(1, 100)/100),
		'water_t' => strval(rand(19, 24) + rand(1, 100)/100),
		'created_at' => $createdAt,
		'updated_at' => $createdAt,
	];
	return $data;
});
