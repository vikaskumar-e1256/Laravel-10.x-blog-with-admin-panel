<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'title', 'subtitle', 'slug', 'body'
        return [
            'title' => fake()->sentence($nbWords = 6, $variableNbWords = true),
            'subtitle' => fake()->sentence($nbWords = 3, $variableNbWords = true),
            'slug' => fake()->slug(),
            'body' => fake()->text($maxNbChars = 500),
            'status' => true,
            'posted_by' => 0,
            'created_at' => fake()->dateTime($max = 'now'),
            'updated_at' => fake()->dateTime($max = 'now'),
        ];
    }

    /**
     * Attach categories and tags to the post.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Attach random categories
            $categories = Category::inRandomOrder()->limit(rand(1, 3))->get();
            $post->categories()->attach($categories);

            // Attach random tags
            $tags = Tag::inRandomOrder()->limit(rand(1, 5))->get();
            $post->tags()->attach($tags);
        });
    }
}
