<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
            ->count(5)
            ->create()
            ->each(function ($post) {
                Comment::factory()->count(3)->create([
                    'post_id' => $post->id,
                ]);
            });
    }
}

