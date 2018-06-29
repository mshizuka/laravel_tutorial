@extends('layouts.app')

@section('title', 'index')

@section('content')
<h1>
<div class="mark">
Blog
</div>
</h1>
    <div　align="left">
        <form action="{{action('PostsController@create')}}">
        <button class="btn">新規記事作成</button>
        </form>
    </div>
{{-- 検索バー　--}}
<div>
    {{ Form::open(['route' => 'posts.index','method' => 'GET']) }}
    {{ Form::text('keywords', null,['placeholder'=>'検索ワードを入力']) }}
        <div>
        日付指定する場合は以下を選択
            <div>
                {{ Form::date('fromDate')}}以降
                {{ Form::date('toDate')}}まで
            </div>
        {{ Form::submit('検索',['class' =>'btn']) }}
        {{ Form::close() }}
        </div>
</div>
{{-- セッションメッセージ表示箇所 --}}
<ul>
    @if(Session::has('message'))
        <div class="container mt-2">
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        </div>
    @endif
{{-- ここまで　--}}

    <div class="paginate">
        {{ $posts->appends(Request::only('keywords'))->links() }}
    </div>

    <table class="table table-hover">
        <tr>
            <th>タイトル</th>
            <th>更新日</th>
            <th> </th>
            <th> </th>

        </tr>
    @foreach ($posts as $post)
        <tr>
            <td>
                <a href="{{ action('PostsController@show', $post)}}" class="show">{{ $post->title }}</a>
            </td>
            <td>{{ $post->created_at}}</td>
            <td>
                <form action="{{action('PostsController@edit',$post)}}">
                <button class="btn">編集</button>
                </form>
            </td>
            <td>
                {{ Form::open( ['route' =>['posts.destroy', $post->id],'onSubmit'=> 'return disp();','method'=>'delete']) }}
                {{ Form::submit('削除',['class' =>'btn']) }}
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
        </div>
    </li>
    @endforeach
    </table>
<div class="paginate">
    {{ $posts->appends(Request::only('keywords'))->links() }}
</div>

</ul>


@endsection
