<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0;');
       DB::table('posts')->truncate();
       factory(Post::class, 30)->create();
       DB::statement('SET FOREIGN_KEY_CHECKs=1;');
    }
}
