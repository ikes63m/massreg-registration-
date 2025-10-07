<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\IndustryType; // CRUCIAL: Make sure this is present
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganisationFactory extends Factory
{
    // ... (rest of the file)

    public function definition(): array
    {
        // 1. Get a list of active industry types for realistic data
        $industryTypes = IndustryType::where('is_active', true)->pluck('type')->toArray();
        
        // Ensure there are types, default to 'Technology' if the seeder hasn't run yet
        if (empty($industryTypes)) {
            $industryTypes = ['Technology', 'Finance', 'Healthcare'];
        }

        return [
            // Generate a unique company name
            'name' => $this->faker->unique()->company, 
            
            // Pick a random industry from our seeded types
            'industry' => $this->faker->randomElement($industryTypes), 
            
            // Generate a long paragraph for the description
            'description' => $this->faker->catchPhrase() . '. ' . $this->faker->paragraph(3),
            
            // Randomly set status to true (70% chance) or false (30% chance)
            'is_active' => $this->faker->boolean(70), 
        ];
    }
}