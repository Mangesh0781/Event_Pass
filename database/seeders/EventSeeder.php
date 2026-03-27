<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Event::create([
        'user_id' => 1, // Make sure a user with ID 1 exists!
        'title' => 'Laravel Workshop',
        'description' => 'Learn the basics of Laravel 11.',
        'venue' => 'Pune IT Park',
        'event_date' => now()->addDays(10),
        'total_seats' => 50,
        'booked_seats' => 0,
    ]);
}
}
