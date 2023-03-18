<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\GlobalTeam;
use App\Models\LocalTeam;
use App\Models\NationalTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        LocalTeam::factory(3)->has( Conversation::factory(1)->count(1), 'Conversation')->create();
        // GlobalTeam::factory(3)->has( Conversation::factory(1)->count(1), 'Conversation')->create();
        // NationalTeam::factory(3)->has( Conversation::factory(1)->count(1), 'Conversation')->create();

    }
}
