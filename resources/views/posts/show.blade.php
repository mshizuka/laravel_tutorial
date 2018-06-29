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
    </div>
{{--ここから下にコメント表示--}}
<p>
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
{{--ここから下コメントフォーム--}}
<div class="container">
    <div class="row">
        {{ Form::open(['url'=>'/comment',$post->id]) }}
        <div class="col-sm-2">名前</div>
            <div class="col-sm-10 form-inline" style="padding: 3px;">
                {{ Form::text('name','',['class'=>'form-control input-sm','placeholder'=>'名前を入力']) }}
                <p>{{ $errors->first('name') }}</p>
            </div>
        </div>
        <div class="col-sm-2">コメント</div>
            <div class="col-sm-10" style="padding: 3px;">
                {{ Form::textarea('comment','',['class'=>'form-control input-sm','placeholder'=>'コメントを入力']) }}
                <p>{{ $errors->first('comment') }}</p>
            </div>
        </div>
        <div class="text-center" style="padding: 30px;">
            {{ Form::submit('送信',['class' => 'btn btn-success']) }}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            {{ Form::close() }}
            <form style="dispay:inline" action="{{action('PostsController@index')}}">
            <button class="btn">戻る</button>
            </form>
        </div>
    </div>
</div>

<p>
</div>
@endsection

