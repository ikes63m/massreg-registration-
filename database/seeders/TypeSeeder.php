<?php

namespace Database\Seeders;

use App\Models\ContactType; // CRITICAL: This was causing the previous error!
use App\Models\IndustryType; // CRITICAL: This is needed for the first part
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Industry Types: These must be inserted first, as the OrganisationFactory depends on them.
        IndustryType::create([
            'type' => 'Technology',
            'description' => 'Companies focused on software, hardware, or internet services.',
            'is_active' => true,
        ]);
        IndustryType::create([
            'type' => 'Finance',
            'description' => 'Institutions handling money management, including banks and investment firms.',
            'is_active' => true,
        ]);
        IndustryType::create([
            'type' => 'Healthcare',
            'description' => 'Organizations providing medical services, equipment, or pharmaceuticals.',
            'is_active' => true,
        ]);
        IndustryType::create([
            'type' => 'Manufacturing',
            'description' => 'Businesses involved in producing goods from raw materials.',
            'is_active' => true,
        ]);
        IndustryType::create([
            'type' => 'Retail',
            'description' => 'Companies that sell goods directly to consumers.',
            'is_active' => true,
        ]);

        // 2. Contact Types: Needed for the Contacts module setup.
        ContactType::create([
            'type' => 'Email',
            'description' => 'Primary email contact for the organization.',
            'is_active' => true,
        ]);
        ContactType::create([
            'type' => 'Phone (Office)',
            'description' => 'Main landline or office number.',
            'is_active' => true,
        ]);
        ContactType::create([
            'type' => 'Phone (Mobile)',
            'description' => 'Direct mobile contact for a specific person.',
            'is_active' => true,
        ]);
        ContactType::create([
            'type' => 'Website',
            'description' => 'Organization\'s primary website URL.',
            'is_active' => true,
        ]);
    }
}