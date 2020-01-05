<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
	public function run()
	{
		$this->call(UsersTableSeeder::class);
//		factory(\App\Models\User::class, 20)->create();
		factory(\App\Models\Tariffs::class, 60)->create();
		factory(\App\Models\UPCalculator::class, 80)->create();
	}
}
