<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $admin = User::where('role', 'admin')->first();
        $editor = User::where('role', 'editor')->first();

        if (!$admin || !$editor) {
            $this->command->error("Admin or Editor user not found. Make sure both users exist before seeding posts.");
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            Post::create([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(5),
                'user_id' => $admin->id,
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Post::create([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(5),
                'user_id' => $editor->id,
            ]);
        }

        $this->command->info("✅ 10 posts created by admin and 5 posts by editor.");
    }
}
