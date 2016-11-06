<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	  DB::table('users')->delete();
      $users = [];
      for ($i = 1; $i <= 3; $i++)
      {
      		$users[] = [
      			'name' => "User {$i}",
      			'email' => "user{$i}@mail.com",
      			'password' => bcrypt("user{$i}")
      		];
      }
      DB::table('users')->insert($users);

      /**
         * Run the database seeds.
         *
         * @return void
       */
      DB::table('contacts')->delete();

      	$faker = Faker::create();
        $contacts = [];
		foreach (range(1, 20) as $index) {
			$contacts[] = [
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
		}

        DB::table('contacts')->insert($contacts);
    }
}
