<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\UPCalculator;
use Faker\Generator as Faker;

$factory->define(UPCalculator::class, function (Faker $faker) {

	$createdAt = $faker->dateTimeBetween('-13 months', '-1 months');

	$data = [
		'user_id' => rand(1, 6),
		'electricity' => strval(rand(50, 380).'/'.rand(200, 600)),
		'gaz' => strval(rand(5, 15).'/'.rand(60, 120)),
		'water' => strval(rand(4, 9).'/'.rand(80, 190)),
		'heat' => strval(rand(00, 1700)),
		'intercom' => strval(rand(15, 20)),
		'utilities' => strval(rand(120, 140)),
		'total' => strval(rand(600, 2500)),
		'created_at' => $createdAt,
		'updated_at' => $createdAt,
	];
	return $data;
});
