<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        Author::factory(10)->create()->each(function (Author $author) {
            Book::factory(rand(2, 5))->create(['author_id' => $author->id])
                ->each(function (Book $book) {
                    $categoryIds = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
                    $book->categories()->attach($categoryIds);
                });
        });
    }
}