<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        	'name' => $faker->name,
			'email' => $faker->email,
			'phone' => $faker->phoneNumber,
			'address' => "{$faker->streetName} {$faker->postcode} {$faker->city}",
			'company' => $faker->company,
			'created_at' => new DateTime,
			'updated_at' => new DateTime,
			'group_id' => rand(1, 3),
			'user_id' => rand(1, 3)
    ];
});