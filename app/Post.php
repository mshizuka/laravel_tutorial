<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','content','user_id'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // public function addComment($comment)
    // {
    //     // 新しいレコードを作成
    // 	Comment::create([
    // 		'comment' => $comment,
    // 		'post_id' => $this->id
    //     ]);
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
