<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'librarian', 'email' => 'librarian@example.com', 'password' => bcrypt(123456), 'student' => false],
            ['name' => 'student', 'email' => 'student@example.com', 'password' => bcrypt(123456), 'student' => true]
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
