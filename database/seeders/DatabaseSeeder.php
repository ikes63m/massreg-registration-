<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TypeSeeder MUST run first as OrganizationFactory depends on the data it inserts.
        $this->call([
            TypeSeeder::class,
            OrganisationSeeder::class,
        ]);
    }
}