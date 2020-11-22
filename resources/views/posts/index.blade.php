@extends('layouts.test')

@section('title', 'Posts')

@section('content')
    <p>Posts on the network:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.singlepost', ['id' => $post->id]) }}">{{ $post->id }}</a></li>
        @endforeach
    </ul>
    <a href="{{ route('posts.create') }}">Create Post</a>
@endsection

