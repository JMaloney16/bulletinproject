@extends('layouts.test')

@section('title', 'Post Details')
    
@section('content')
    <h1>{{ $post->title }}</h1>
    @if(!empty($post->imagepath))
    <img src={{ $post->imagepath }}>
    @endif
    <ul>
        <li>Content: {{ $post->content }}</li>
        <li>Imagepath: {{$post->imagepath ?? 'n/a' }} </li>
    </ul>
    <h2>Comments</h2>
    <div>
        @livewire('add-comment', ['post' => $post,'comments' => $comments])
    </div>
    @if (Auth::id() == $post->user->id || Auth::user()->is_admin == 1)
    <form method="POST"
        action="{{ route('posts.destroy', [$post]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    @endif
    <p><a href="{{ route('posts.index') }}">Back</a></p>
    
@endsection