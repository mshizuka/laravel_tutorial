@extends('layouts.app')

@section('title','新規記事作成')

@section('content')
<div class="container">
    <h1>新規記事作成</h1>
    <form method="post" action="{{ url('/posts') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label>タイトル</label>
        <input type="text" class="form-control" name="title" placeholder="タイトルを入力してください" value="{{old('title')}}">
    </div>
        @if ($errors->has('title'))
        <span class="error">{{ $errors->first('title') }}</span>
        @endif
    <div class="form-group">
        <label>本文</label>
        <textarea rows="7" name="content" class="form-control" placeholder="記事本文を入力してください">{{old('content')}}</textarea>
    </div>
        @if ($errors->has('content'))
        <span class="error">{{ $errors->first('content') }}</span>
        @endif
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <div class="form-group">
        <button input type="button" class="btn btn-default" onclick="history.back()">戻る</button>
        <button input type="submit" class="btn btn-success">作成</button>
    </div>
    </form>
</div>
@endsection
