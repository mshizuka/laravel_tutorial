@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container">
    <h1>
        <div class="mark">
        Blog
        </div>
    </h1>
{{-- 記事の新規作成リンクはログインした後のメニューにのみ表示させるようにしたため削除
<div>
    <form action="{{action('PostsController@create')}}">
    <button class="btn btn-success">新規記事作成</button>
    </form>
</div>
--}}

{{-- 検索バー　--}}
    <div class="form-group">
        {{ Form::open(['route' => 'posts.index','method' => 'GET']) }}
        {{ Form::text('keywords', null,['placeholder'=>'検索ワードを入力']) }}
            <div>
            日付指定する場合は以下を選択
                <div>
                    {{ Form::date('fromDate')}}以降
                    {{ Form::date('toDate')}}まで
                </div>
            {{ Form::submit('検索',['class' =>'btn btn-primary']) }}
            {{ Form::close() }}
            </div>
        </div>
    </div>
{{-- ここまで --}}


{{-- セッションメッセージ表示箇所 --}}
    @if(Session::has('message'))
        <div class="container mt-2">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    @endif
{{-- ここまで　--}}

    <div class="container">
        <div class="paginate">
            {{ $posts->appends(Request::only('keywords'))->links() }}
        </div>
{{-- ページカウント（アイテム数）表示ここから --}}
        <div >
            {{ $posts->total() }}件中{{ $posts->count() }}件表示中
        </div>
{{-- ここまで --}}

{{-- ここから記事一覧　--}}
        <table class="table table-hover">
            <tr>
                <th>タイトル</th>
                <th>更新日</th>
                <th>投稿者</th>
                <th> </th>
                <th> </th>
            </tr>
        @foreach ($posts as $post)
            <tr>
                <td>
                    <a href="{{ action('PostsController@show', $post)}}" class="show">{{ $post->title }}</a>
                </td>
                <td>{{ $post->created_at}}</td>
                <td>{{ $post->user->name }}</td>
                <td>
                    <div class="btn btn-default" role="button">
                        <a href="{{action('PostsController@edit',$post)}}" class="edit">編集</a>
                    </div>
                </td>
                <td>
                    {{ Form::open( ['route' =>['posts.destroy', $post->id],'onSubmit'=> 'return disp();','method'=>'delete']) }}
                    {{ Form::submit('削除',['class' =>'btn-danger']) }}
                    {{ Form::close() }}
                </td>
                <script>
                function disp(){
                    if(confirm("本当に削除しますか？")){
                    }else{
                        return false;
                    }
                };
                </script>
        @endforeach
        </table>
    <div class="paginate">
        {{ $posts->appends(Request::only('keywords'))->links() }}
    </div>
</div>
@endsection
