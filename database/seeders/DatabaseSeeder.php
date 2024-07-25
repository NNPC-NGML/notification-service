<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('notification_tasks')->truncate();

        Event::fakeFor(function () {
            // Create models without triggering events
            // YourModel::factory()->count(5)->create();
            \App\Models\NotificationTask::factory(50)->create();
        });


        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\NotificationTask::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}