<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'description' => 'A classic American novel', 'price' => 12.99, 'stock' => 50, 'category_id' => 1, 'isbn' => '9780743273565'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'description' => 'A gripping tale of racial injustice', 'price' => 14.99, 'stock' => 45, 'category_id' => 1, 'isbn' => '9780061120084'],
            ['title' => '1984', 'author' => 'George Orwell', 'description' => 'A dystopian social science fiction', 'price' => 13.99, 'stock' => 60, 'category_id' => 1, 'isbn' => '9780451524935'],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'description' => 'A brief history of humankind', 'price' => 18.99, 'stock' => 40, 'category_id' => 2, 'isbn' => '9780062316097'],
            ['title' => 'Educated', 'author' => 'Tara Westover', 'description' => 'A memoir about education', 'price' => 16.99, 'stock' => 35, 'category_id' => 2, 'isbn' => '9780399590504'],
            ['title' => 'A Brief History of Time', 'author' => 'Stephen Hawking', 'description' => 'From the Big Bang to Black Holes', 'price' => 15.99, 'stock' => 30, 'category_id' => 3, 'isbn' => '9780553380163'],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'description' => 'A handbook of agile software craftsmanship', 'price' => 42.99, 'stock' => 25, 'category_id' => 4, 'isbn' => '9780132350884'],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Andrew Hunt', 'description' => 'Your journey to mastery', 'price' => 39.99, 'stock' => 28, 'category_id' => 4, 'isbn' => '9780135957059'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
