<?php

namespace App\Policies;

use App\User;
use App\Post;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */

    //以下通常の記事に対する操作
    public function delete(User $user, Post $post)
    {
        //return $user->id === $post->user_id;
    }


    public function edit(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function destroy(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

//以下コメントに対する操作
    //コメント編集画面へ移動する
    public function commentEdit(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    //コメントを削除する
    public function commentDelete(User $user,Comment $comment)
    {
        return $user->id === $comment->user_id;
    }



}
