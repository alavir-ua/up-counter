<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		$data = [
			[
				'name' => 'Leha',
				'email' => 'leha@gmail.com',
				'password' => bcrypt('leha1234567'),
			],
			[
				'name' => 'Yra',
				'email' => 'yra@gmail.com',
				'password' => bcrypt('yra1234567'),
			],
			[
				'name' => 'Pasha',
				'email' => 'pasha@gmail.com',
				'password' => bcrypt('pasha1234567'),
			],
			[
				'name' => 'Gena',
				'email' => 'gena@gmail.com',
				'password' => bcrypt('gena1234567'),
			],
			[
				'name' => 'Lena',
				'email' => 'lena@gmail.com',
				'password' => bcrypt('lena1234567'),
			],
			[
				'name' => 'Olya',
				'email' => 'olya@gmail.com',
				'password' => bcrypt('olya1234567'),
			],
		];
		DB::table('users')->insert($data);
	}
}
