<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction', 'description' => 'Fictional stories and novels'],
            ['name' => 'Non-Fiction', 'description' => 'Real-life stories and facts'],
            ['name' => 'Science', 'description' => 'Scientific books and research'],
            ['name' => 'Technology', 'description' => 'Technology and programming books'],
            ['name' => 'History', 'description' => 'Historical books and biographies'],
            ['name' => 'Self-Help', 'description' => 'Personal development books'],
            ['name' => 'Business', 'description' => 'Business and entrepreneurship'],
            ['name' => 'Children', 'description' => 'Books for children'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
