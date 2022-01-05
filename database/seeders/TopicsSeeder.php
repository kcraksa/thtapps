<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Topics;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topics::factory()->count(10)->create();
    }
}
