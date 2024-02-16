<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "monSite" => fake()->name(),
            "smtp" => fake()->name(),
            "numero" => fake()->name(),
            "adresseMail" => fake()->name(),
            "adressePysique" => fake()->name(),
            "siteName" => fake()->name(),
            "siteEmail" => fake()->name(),
            "siteContact1" => fake()->name(),
            "siteContact2" => fake()->name(),
            "siteLogoUrl" => fake()->name(),
            "siteLink" => fake()->name(),
            "siteAddress" => fake()->name(),
            "facebookPage" => fake()->name(),
            "siteCopyright" => fake()->name(),
            "siteKeywords" => fake()->name(),
            "siteAuthor" => fake()->name(),
            "linkedlinPage" => fake()->name(),
            "instagramPage" => fake()->name(),
            "twitterPage" => fake()->name(),
            "youtubePage" => fake()->name(),
            "siteDesc" => fake()->name(),
        ];
    }
}
