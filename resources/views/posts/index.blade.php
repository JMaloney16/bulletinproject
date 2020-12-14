@extends('layouts.test')

@section('title', 'Posts')

@section('content')
    <p>Posts on the network:</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.singlepost', [$post]) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
    <a href="{{ route('posts.create') }}">Create Post</a>
@endsection

