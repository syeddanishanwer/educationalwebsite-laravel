<?php

namespace Database\Factories;

use App\Models\instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates a standard full name
            'name' => $this->faker->name(), 
            
            // Generates a random image file name or URL path
            'img' => $this->faker->imageUrl(400, 400, 'people'), 
            
            // Generates a job title matching an academic/professional instructor environment
            'designation' => $this->faker->jobTitle(), 
            
            // Generates valid domain URLs for specific social profiles
            'facebook_link' => $this->faker->url(),
            'twitter_link' => $this->faker->url(),
            'instagram_link' => $this->faker->url(),
            
            // Randomly assigns an operational state such as 'active' or 'inactive'
            'status' => $this->faker->randomElement(['active', 'inactive']), 
            
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
