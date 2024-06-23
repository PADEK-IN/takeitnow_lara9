<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory(5)->create();
        Review::factory(3)->create();
    }
}
