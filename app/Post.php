<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function addComment($comment)
    {
        // 新しいレコードを作成
    	Comment::create([
    		'comment' => $comment,
    		'post_id' => $this->id
    	]);
    }

   protected $fillable = ['title','content'];
}
