<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keywords = $request->get('keywords');
        $from = $request->get('fromDate');
        $to = $request->get('toDate');
        $query = Post::query();
        //記事の内容からフリーワード検索
        if(!empty($keywords)) {
            $query->where('content','like', "%$keywords%");
        }
        //日付入力フォームから得られたデータから絞り込み
        if($from){
            $query->whereDate('created_at','>=' ,$from);
        }
        if($to){
            $query->whereDate('created_at','<=' ,$to);
        }
        //得られた結果を日付降順で表示
        $posts = $query->latest('created_at')->paginate(20);
        return view('posts.index', ['posts' => $posts,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        $post ->save();
        $request->session()->flash('message', '投稿しました');
        return redirect()->route('posts.show', [$post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    return view('posts.show')->with ('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post ->update($request->all());
        $post ->save();
        $request->session()->flash('message', '更新しました');
        return redirect()->route('posts.show', [$post->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return redirect('posts')->with('message', '削除しました');
    }

    public function comment(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'comment' => 'required|min:3|max:30',
        ],[
            'name.required' => '※名前を入力してください',
            'name.max' => '※名前は30文字以内にしてください',
            'comment.required' => '※コメントを入力してください',
        ]);
        Comment::create($request->all());
        $request->session()->flash('message', 'コメントしました。');
        return redirect()->route('posts.show', [$request->input('post_id')]);
    }

}
