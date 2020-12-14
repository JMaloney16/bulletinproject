@extends('layouts.test')

@section('title', 'User Details')

@section('content')
    <h1>{{ $user->name }}</h1>
    <h2>Comments</h2>
    <ul>
        @foreach ($comments as $comment)
            <li>Post ID:<a href="{{ route('posts.singlepost', ['post' => $comment->post_id]) }}">{{ $comment->post_id }}</a> - {{ $comment->content}}</li>
        @endforeach
    </ul>
@endsection