@extends('layouts.app')

@section('title','新規記事作成')

@section('content')

<h1>新規記事作成</h1>
<form method="post" action="{{ url('/posts') }}">
    {{ csrf_field() }}
    <p>
        <input type="text" name="title" style="width:300px;" placeholder="タイトルを入力してください" value="{{old('title')}}">
        @if ($errors->has('title'))
        <span class="error">{{ $errors->first('title') }}</span>
    @endif
    </p>
    <p>
        <textarea name="content" style="width:300px;" placeholder="記事本文を入力してください">{{old('content')}}</textarea>
        @if ($errors->has('content'))
        <span class="error">{{ $errors->first('content') }}</span>
        @endif
    </p>
    <p>
        <input type="submit" value="作成" class="btn">
    </p>
</form>
<div>
    <form action="{{action('PostsController@index')}}">
        <button class="btn">戻る</button>
    </form>
</div>
@endsection
