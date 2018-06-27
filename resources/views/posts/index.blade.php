@extends('layouts.app')

@section('title', 'index')

@section('content')
<h1>
    Blog

</h1>
        <a href="{{ url('/posts/create') }}">[新規記事作成]</a>
 <ul>

@if(Session::has('message'))
 <div class="container mt-2">
  <div class="alert alert-success">
  {{ session('message') }}
  </div>
</div>
@endif

@foreach ($posts as $post)
    <li>
    <a href="{{ action('PostsController@show', $post)}}" class="show">{{ $post->title }}</a>
 更新日：{{ $post->created_at}}
    <a href="{{ action('PostsController@edit', $post)}}" class="edit">[編集]</a>
    {{ Form::open( ['route' =>['posts.destroy', $post->id],'onSubmit'=> 'return disp();','method'=>'delete']) }}
    {{ Form::submit('削除') }}
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


@endsection
