<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        User::truncate();

        foreach(range(1, 5) as $index)
        {
            User::create([
            	'username' => $faker->username,
                'email' => $faker->email,
                'password' => Hash::make('1234')
            ]);
        }
    }

}
