<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class general_databaseFactory extends Factory
{
    protected $model = \App\Models\general_database::class;
    protected $table = 'default_table';

    public function forTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function definition()
    {
        switch ($this->table) {
            case 'dashboard':
                return [
                    'act_id' => Str::uuid(),
                    'act_username' => $this->faker->unique()->userName,
                    'act_action' => $this->faker->word,
                    'act_date' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            case 'forums':
                return [
                    'post_id' => $this->faker->unique()->randomNumber(),
                    'concern' => $this->faker->sentence(),
                    'posted_by' => $this->faker->name(),
                    'date' => $this->faker->dateTime(),
                    'approved_by' => $this->faker->name(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            // Add more cases for other tables as needed
            default:
                return [];
        }
    }
}

