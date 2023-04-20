<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(rand(3, 8), true);
        $txt = fake()->realText(rand(1000, 4000));
        $isPublished = rand(1, 5) > 1;
        $createdAt = fake()->dateTimeBetween('-3 months', '-2 days');

        $data = [
            'category_id' => rand(1, 11),
            'user_id' => (rand(1, 5) == 5) ? 1 : 2,
            'title' => $title,
            'slug' => str_slug($title),
            'excerpt' => fake()->text(rand(40, 100)),
            'content_raw' => $txt,
            'content_html' => $txt,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? fake()->dateTimeBetween('-2 months', '-1 days') : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
        return $data;
    }
}
