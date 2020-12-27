@extends('layouts.test')

@section('title', 'Tag Details')

@section('content')
    <h1 class="text-lg">Posts tagged with: {{ $tag->name }}</h1>
    
    <ul>
        @foreach ($posts as $post)
            <li class="hover:underline">
                <a href="{{ route('posts.singlepost', [$post]) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection