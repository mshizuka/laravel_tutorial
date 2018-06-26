@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{!! nl2br(e($post->content)) !!}</p>
<a href="{{ action('PostsController@index') }}">back</a>
@endsection
