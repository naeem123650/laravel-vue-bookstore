<?php

namespace Modules\Book\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Book\Entities\Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => fake()->text(20),
            "author" => fake()->name(),
            "genre" => fake()->text(7),
            "description" => fake()->paragraph(),
            "isbn" => fake()->isbn10(),
            "image" => fake()->imageUrl(300, 500),
            "published" => now(),
            "publisher" => fake()->name(),
        ];
    }
}
