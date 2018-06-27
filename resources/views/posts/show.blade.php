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

<h1>{{ $post->title }}</h1>
<p>{!! nl2br(e($post->content)) !!}</p>
<a href="{{ action('PostsController@index') }}">[戻る]</a>
@endsection
