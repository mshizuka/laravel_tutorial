<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentsController extends Controller
{

    public function edit(Postrequest $request , Comment $comment)
    {
        $this->authorize('edit', $post);
        return view('posts.edit')->with('post',$post);
    }
}
