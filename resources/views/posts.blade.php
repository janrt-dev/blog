@extends('layout')
@section('content')

@foreach ($posts as $post)
  <article>
   {{--  {!!   $post!!}  --}}
  <h1>
    <a href="/posts/{!! $post->slug  !!}">
    {!! $post->title  !!}
    </a>
    </h1>
  <p> {!!$post->excerpt  !!}</p>
    </article>
@endforeach
@endsection
