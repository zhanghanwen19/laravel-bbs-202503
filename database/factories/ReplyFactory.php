<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->realText(),
            'topic_id' => DB::table('topics')->inRandomOrder()->value('id'),
            'user_id' => DB::table('users')->inRandomOrder()->value('id'),
        ];
    }
}
