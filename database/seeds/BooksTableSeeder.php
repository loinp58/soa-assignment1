<?php

use Illuminate\Database\Seeder;
use App\Book;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            ['name' => 'Harry Potter and the Deathly Hallows (Book 7)', 'isbn10' => '0545139708', 'isbn13' => '9780545139700', 'author' => 'J.K. Rowling', 'description' => "The brilliant, breathtaking conclusion to J.K. Rowling's spellbinding series is not for the faint of heart--such revelations, battles, and betrayals await in Harry Potter and the Deathly Hallows that no fan will make it to the end unscathed"],
            ['name' => 'Harry Potter and the Half-Blood Prince (Book 6)', 'isbn10' => '0439785960', 'isbn13' => '9780439785969', 'author' => 'J.K. Rowling', 'description' => "The war against Voldemort is not going well; even the Muggles have been affected. Dumbledore is absent from Hogwarts for long stretches of time, and the Order of the Phoenix has already suffered losses."],
            ['name' => 'Harry Potter And The Order Of The Phoenix', 'isbn10' => '0439358078', 'isbn13' => ' 9780439358071', 'author' => 'J.K. Rowling', 'description' => "In his fifth year at Hogwart's, Harry faces challenges at every turn, from the dark threat of He-Who-Must-Not-Be-Named and the unreliability of the government of the magical world to the rise of Ron Weasley as the keeper of the Gryffindor Quidditch Team."],
        ];

        foreach($books as $book) {
            Book::create($book);
        }
    }
}
