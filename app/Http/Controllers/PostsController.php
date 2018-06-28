<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

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

    /* コメント投稿時に呼び出されるコントローラのつもり。
     上のupdateをコピーしている。…と言っても使うデータベースが異なっていたらコントローラー
     自体も変えるべきなのか・・？(6/27)

       public function comment(PostRequest $request)
    {
        $comment ->Comment:create($request->all());  Commentモデルの制約に従って動く
        Commentモデル作らないと
        $comment ->save(); これいる？
        $request->session()->flash('message', 'コメントを投稿しました');
        return redirect()->route('posts.show', [$post->id]);
    }
    コントローラーを一つ更新したら、ウェブルートも追加するっていうのはセットで覚えておいたほうがいいな
    このコントローラーに対応したルートを追加する必要がある
    Viewからルートを経由してここの動作を作用させるので・・・
    */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('posts')->with('message', '削除しました');
    }

    /*
    public function __construct()
    {
        S$this->middleware('auth:admin');
    }
    */
}
