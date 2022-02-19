<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Board;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'board_id' => Board::factory(),
            'user_id' => User::factory(),
            'message' => $this->faker->realText(100),
        ];
    }
}
