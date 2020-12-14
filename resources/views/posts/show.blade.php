@extends('layouts.test')

@section('title', 'Post Details')
    
@section('content')
    <h1>{{ $post->title }}</h1>
    <img src={{ $post->imagepath }}>
    <ul>
        <li>Content: {{ $post->content }}</li>
        <li>Imagepath: {{$post->imagepath ?? 'n/a' }} </li>
    </ul>
    <h2>Comments</h2>
    <ul>
        @foreach ($comments as $comment)
            <li>User:<a href="{{ route('users.singleuser', ['user' => $comment->user_id]) }}">{{ $comment->user->name }}</a> - {{ $comment->content }}</li>
        @endforeach
    </ul>
    
    <form method="POST" action="{{ route('comments.store', ['post' => $post]) }}">
        @csrf
        <p>Enter a comment: <input type="text" name="content"
            value="{{ old('content') }}"></p>
        <input type="submit" value="Post Comment">
    </form>
    @auth
    <form method="POST"
        action="{{ route('posts.destroy', [$post]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    @endauth
    <p><a href="{{ route('posts.index') }}">Back</a></p>
@endsection