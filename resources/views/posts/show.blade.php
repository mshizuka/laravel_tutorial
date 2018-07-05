@extends('layouts.app')
@section('title')
    {{ $post->title }}
@endsection
@section('content')

@if(Session::has('message'))
<div class="container mt-2">
    <div class="alert alert-success">
    {{ session('message') }}
    </div>
</div>
@endif

<h1>
    <div class="mark">
    {{ $post->title }}
    </div>
</h1>

<div class="container">
    <div class="list-group-item">
        <p>{!! nl2br(e($post->content)) !!}</p>
        <p>投稿：{{ $post->user->name }}</p>
    </div>
{{--ここから下にコメント表示--}}
    <p>
    <div class="comments">
	<ul class="list-group">
        <li class="list-group-item">コメント</li>

	    @foreach ($post->comments as $comment)
        <li class="list-group-item">
            <p>名前：{{ $comment->name }}<p>
            <p>{!! nl2br(e($comment->comment)) !!}</p>
            <p>投稿日{{ $comment->created_at }}</p>
                <div align="right">

{{-- 自分なりに考えた、post idをcommenteditに渡すためのヒドゥンフォームつき編集ボタン　
                    <form method="get" action="{{route('posts.commentedit', ['id' => $comment])}}" class="commentedit">
                    <input type="hidden" value="{{$post->id}}" name="post">
                    <button input type="submit" class="btn btn-success">編集</button>
                    </form>

{{-- テキストをボタン風にした編集リンク--}}
                    <p><div class="btn btn-default" role="button">
                    <a href="{{route('posts.commentedit', ['id' => $comment])}}" class="edit">編集</a>
                    </div></p>
{{-- 削除ボタン　--}}
                @auth
　                  <form action="{{ route('posts.commentdelete', ['id' => $comment->id])}}" id="form_{{ $comment->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <a href="#" data-id="{{ $comment->id }}" class="btn btn-danger" onclick="deleteComment(this);">削除</a>
                       {{-- <input type="hidden" class="post_id" value="{{$comment->post->id}}"> この記事のIDを削除する時にコントローラーに渡したかったがいまいち動かない--}}
                    </form>
                    <script>
                    function deleteComment(e) {
                        'use strict';

                        if (confirm('本当に削除していいですか?')) {
                            document.getElementById('form_' + e.dataset.id).submit();
                            }
                        }
                    </script>
                @endauth
                </div>
{{--ここまで--}}
</p>
        </li>
	    @endforeach
	</ul>
    </div>
</div>
{{--ここから下コメントフォーム--}}

<div class="container">
    {{ Form::open(['url'=>'/comment',$post->id]) }}
    <div class="form-group">
        <label>名前:
    </lavel>
        @auth
        {{ auth()->user()->name }}
        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
        @endauth
        @guest
        {{ Form::text('name','',['class'=>'form-control input-sm','placeholder'=>'名前を入力']) }}
        <p>{{ $errors->first('name') }}</p>
        @endguest
    </div>
    <div class="form-group">
        <label>コメント</label>
        {{ Form::textarea('comment','',['class'=>'form-control input-sm','placeholder'=>'コメントを入力']) }}
        <p>{{ $errors->first('comment') }}</p>
    </div>
    <button input type="button" class="btn btn-default" onclick="history.back()">戻る</button>
    <button input type="submit" class="btn btn-success">コメントする</button>
    <input type="hidden" name="post_id" value="{{$post->id}}">
    @auth
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    @endauth
    {{ Form::close() }}
    </div>
</div>

<p>
</div>
@endsection

