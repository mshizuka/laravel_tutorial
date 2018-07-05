<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id','post_id','name','comment'];

    public function posts()
    {
        return $this->belomgsTo('App\Post');
    }

    public function user()
    {
        return $this->belomgsTo('App\User');
    }
}
