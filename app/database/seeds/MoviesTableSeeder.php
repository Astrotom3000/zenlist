<?php

class MoviesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        Movie::truncate();

        foreach(range(1, 5) as $index)
        {
            Movie::create([
                'tmdb_id' => $faker->unique()->randomNumber,
                'imdb_id'=> $faker->unique()->randomNumber,
                'rottentomatoes_id' => $faker->unique()->randomNumber,
                'year' => $faker->year,
                'title' => $faker->sentence(5),
                'description' => $faker->paragraph(3),
                'release_date' => $faker->date,
                'critics_rating' => $faker->randomDigit,
                'audience_rating' => $faker->randomDigit,
                'runtime' => $faker->randomNumber,
                'genre' => $faker->randomNumber,
            ]);
        }
    }

}
