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
<p>{!! nl2br(e($post->content)) !!}</p>
<div>
    <form action="{{action('PostsController@index')}}">
        <button class="btn">戻る</button>
    </form>
</div>
</div>
@endsection

