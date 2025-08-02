<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $posts = Post::all();

        foreach ($posts as $post) {
            Comment::create([
                'comment_text' => 'Nice post! Very helpful.',
                'post_id' => $post->id,
                'user_id' => $admin->id,
            ]);
        }
    }
}
