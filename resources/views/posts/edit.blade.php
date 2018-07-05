@extends('layouts.app')

@section('title','記事編集')

@section('content')
<div class="container">
<h1>記事編集</h1>
<form method="post" action="{{ url('/posts', $post->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <div class="form-group">
        <label>タイトル</label>
        <input type="text" class="form-control" name="title" value="{{old('title',$post->title)}}">
        @if ($errors->has('title'))
        <span class="error">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="form-group">
    <label>本文</label>
     <textarea rows="7" name="content" class="form-control" >{{ old('content', $post->content) }}</textarea>
        @if ($errors->has('content'))
        <span class="error">{{ $errors->first('content') }}</span>
        @endif
    </div>
    <div class="form-group">
        <button input type="button" class="btn btn-default" onclick="history.back()">戻る</button>
        <button input type="submit" class="btn btn-success">作成</button>
    </div>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
</form>
<div>
        <div class="comments">
	<ul class="list-group">
        <li class="list-group-item">コメント</li>
	    @foreach ($post->comments as $comment)
        <li class="list-group-item">
            <p>名前：{{ $comment->name }}<p>
            <p>{{ $comment->comment }}</p>
            <p>投稿日{{ $comment->created_at }}</p>
        </li>
	    @endforeach
	</ul>
    </div>
</div>
</div>
@endsection
