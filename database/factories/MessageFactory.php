<?php
namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->paragraph,
        ];
    }
}