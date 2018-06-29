<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;

class CommentsController extends Controller
{

    public function store(Post $post)
    {
        $comment = Comment::create($request->all());
        $comment->save();
        return redirect()->route('posts.show', [$post->id]);
    }
}
