<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Board;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tester = new User;
        $param = [
            'name' => 'tester',
            'email' => 'test@mail',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/'
        ];

        $tester->fill($param)->save();

        User::factory()->count(3)->hasPosts(2)->create();
    }
}
