<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () {
        factory(\App\Models\User::class, 10)
            ->create()
            ->each(function (\App\Models\User $user) {
                factory(\App\Models\Post::class, 20)
                    ->create(['user_id' => $user->id])
                    ->each(function (\App\Models\Post $post) {
                        factory(\App\Models\Comment::class, 5)->create([
                            'user_id' => rand(1, 10),
                            'post_id' => $post->id
                        ]);
                    });
            });
    }
}
