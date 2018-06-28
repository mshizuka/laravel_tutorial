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

<div class="search">
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

 <ul>
@if(Session::has('message'))
 <div class="container mt-2">
  <div class="alert alert-success">
  {{ session('message') }}
  </div>
</div>
@endif

<div class="paginate">
{{ $posts->appends(Request::only('keywords'))->links() }}
</div>

@foreach ($posts as $post)
    <li>
    <a href="{{ action('PostsController@show', $post)}}" class="show">{{ $post->title }}</a>
 更新日：{{ $post->created_at}}
    <div style="display:inline-flex">
        <form action="{{action('PostsController@edit',$post)}}">
        <button class="btn">編集</button>
        </form>
    </div>
    <div style="display:inline-flex">
    {{ Form::open( ['route' =>['posts.destroy', $post->id],'onSubmit'=> 'return disp();','method'=>'delete']) }}
    {{ Form::submit('削除',['class' =>'btn']) }}
    {{ Form::close() }}
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
<div class="paginate">
{{ $posts->appends(Request::only('keywords'))->links() }}
</div>

</ul>


@endsection
