<?php

namespace Database\Seeders;

use App\Models\UserEvent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserEventSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        UserEvent::create([
            'event_id' => '1214919088699',
            'user_id' => 1,
            'event_status' => 'live'
        ]);

        UserEvent::create([
            'event_id' => '1137437007709',
            'user_id' => 2,
            'event_status' => 'live'
        ]);

        UserEvent::create([
            'event_id' => '1208858892489',
            'user_id' => 3,
            'event_status' => 'live'
        ]);

        UserEvent::create([
            'event_id' => '1137437007709',
            'user_id' => 4,
            'event_status' => 'live'
        ]);

        UserEvent::create([
            'event_id' => '1208858892489',
            'user_id' => 5,
            'event_status' => 'live'
        ]);
        
    }
}
