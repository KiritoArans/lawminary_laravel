<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\general_database;

class general_seeders extends Seeder
{
    public function run()
    {
        // Populate the forums table
        general_database::factory()->forTable('forums')->count(10)->create();
    }
}
