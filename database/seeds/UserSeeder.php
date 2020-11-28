<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'user1@chat.com',
            'name' => 'User1'
        ]);

        factory(User::class)->create([
            'email' => 'user2@chat.com',
            'name' => 'User2'
        ]);

        factory(User::class)->create([
            'email' => 'user3@chat.com',
            'name' => 'User3'
        ]);
    }
}
