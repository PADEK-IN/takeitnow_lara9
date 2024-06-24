<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
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
        User::factory()->admin()->create();
        User::factory()->user()->create();
        Category::factory()->category('Festival Kota')->create();
        Category::factory()->category('Olahraga')->create();
        Category::factory()->category('Musik')->create();
        Event::factory()->event('Festival Anjungan Sumsel', 'Event Pekan adat Sumatera Selatan', '1.jpg', 1)->create();
        Event::factory()->event('Jakabaring Wonderful Run', 'Event lari di Stadium Jakabaring', '2.jpg', 2)->create();
        Event::factory()->event('Pesta Rakyat Simpandes', 'Event musik pesta rakyat jakabaring palembang', '3.png', 3)->create();
        Event::factory()->event('Liga 1 Esports Nasional', 'Event olahraga digital pertama di jakabaring palembang', '4.jpg', 2)->create();
        Event::factory()->event('Nyanyi riang gembira', 'Event musik authentic city plaza gelora jakabaring palembang', '5.jpg', 3)->create();

    }
}
