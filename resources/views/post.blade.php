
@extends('layout')
@section('content')
    <article>

        {!!$post->body  !!}
    </article>
    <a href="/">Go Back</a>

@endsection


