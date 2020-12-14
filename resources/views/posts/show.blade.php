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
            <li>User ID:<a href="{{ route('users.singleuser', ['user' => $comment->user_id]) }}">{{ $comment->user_id }}</a> - {{ $comment->content }}</li>
        @endforeach
    </ul>

    <form method="POST"
        action="{{ route('posts.destroy', [$post]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <p><a href="{{ route('posts.index') }}">Back</a></p>
@endsection