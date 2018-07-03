@extends('layouts.app')

@section('title','記事編集')

@section('content')
<h1>記事編集</h1>
<form method="post" action="{{ url('/posts', $post->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <div class="form-group">
        <input type="text" class="form-control" name="title" style="width:300px;" value="{{old('title',$post->title)}}">
        @if ($errors->has('title'))
        <span class="error">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="form-group">
     <textarea name="content" class="form-control" style="width:300px;" >{{ old('content', $post->content) }}</textarea>
        @if ($errors->has('content'))
        <span class="error">{{ $errors->first('content') }}</span>
        @endif
    </div>
    <div class="form-group">
        <input type="submit" value="編集" class="btn">
    </div>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
</form>
<div>
    <form action="{{action('PostsController@index')}}">
        <button class="btn">戻る</button>
    </form>
</div>

@endsection
