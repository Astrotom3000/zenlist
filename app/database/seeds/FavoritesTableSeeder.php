<?php

class FavoritesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        Favorite::truncate();

        foreach(range(1, 5) as $index)
        {
            $userId = User::orderBy(DB::raw('RAND()'))->first()->id;
            $movieId = Movie::orderBy(DB::raw('RAND()'))->first()->id;

            Favorite::create([
                'user_id' => $userId,
                'movie_id' => $movieId

            ]);
        }
    }

}
