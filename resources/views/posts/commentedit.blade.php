@extends('layouts.app')

@section('title','コメント編集')

@section('content')
<div class="container">
<h1>コメント編集</h1>
<form method="post" action="{{route('posts.commentupdate', $comment->id)}}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <div class="form-group">
        <label>名前</label>
        <input type="text" class="form-control" name="name" value="{{old('name',$comment->name)}}">
        @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
    <label>本文</label>
     <textarea rows="7" name="comment" class="form-control" >{{ old('comment', $comment->comment) }}</textarea>
        @if ($errors->has('comment'))
        <span class="error">{{ $errors->first('comment') }}</span>
        @endif
    </div>
        <input type="hidden" name="id" value="{{$comment->id}}">
        <input type="hidden" name="post_id" value="{{$comment->post_id}}">
        <input type="hidden" name="user_id" value="{{$comment->user_id}}">
    <div class="form-group">
        <button input type="button" class="btn btn-default" onclick="history.back()">戻る</button>
        <button input type="submit" class="btn btn-success">送信</button>
    </div>
</form>


</div>
@endsection
