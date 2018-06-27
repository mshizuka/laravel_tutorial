@extends('layouts.app')

@section('title','記事編集')

@section('content')
<h1>記事編集</h1>
<form method="post" action="{{ url('/posts', $post->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <p>
        <input type="text" name="title" style="width:300px;" value="{{old('title',$post->title)}}">
        @if ($errors->has('title'))
        <span class="error">{{ $errors->first('title') }}</span>
        @endif
    </p>
    <p>
     <textarea name="content" style="width:300px;" >{{ old('content', $post->content) }}</textarea>
        @if ($errors->has('content'))
        <span class="error">{{ $errors->first('content') }}</span>
        @endif
    </p>
    <p>
        <input type="submit" value="編集">
    </p>
</form>

<a href="{{ action('PostsController@index') }}">戻る</a>
@endsection
