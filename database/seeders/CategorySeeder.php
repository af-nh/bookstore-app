<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Fiction', 'Non-Fiction', 'Science', 'Technology', 'History', 'Biography'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}