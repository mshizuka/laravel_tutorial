@extends('layouts.app')

@section('title', 'index')

@section('content')
    <h1>Blog</h1>
    <ul>
@foreach ($posts as $post)
    <li>{{ $post->title }}</a>
     更新日：{{ $post->created_at}}
    <a href="{{ action('PostsController@edit', $post)}}" class="edit">[編集]</a>
{{--ドットインストールのやつ
    <a href="#" class="del" data-id="{{ $post->id }}">[x]</a>
    <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
    </form>
    <script>
    (function() {
    'use strict';

    var cmds = document.getElementsByClassName('del');
    var i;

    for (i = 0; i < cmds.length; i++) {
    cmds[i].addEventListener('click', function(e) {
      e.preventDefault();
      if (confirm('削除してよろしいですか？')) {
        document.getElementById('form_' + this.dataset.id).submit();
      }
    });
    }

    })();
    </script>
--}}

    {{ Form::open( ['route' =>['posts.destroy', $post->id],'onSubmit'=> 'return disp();','method'=>'delete']) }}
    {{ Form::submit('x') }}
    {{ Form::close() }}
    <script>
        function disp(){
            if(confirm("本当に削除しますか？")){
            }else{
                return false;
            }
        };
</script>
    </li>

@endforeach
</ul>
<a href="{{ action('PostsController@create') }}">新規記事作成</a>

@endsection
