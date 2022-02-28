@extends('layouts.test')

@section('title', 'User Details')

@section('content')
    <div class="px-4 md:px-12">
        <div class="container bg-white rounded-lg shadow-lg my-6 mx-auto px-4 justify-center md:px-8">
            <h1 class="text-xl font-bold my-6 pt-6">{{ $user->name }}</h1>
            <div>
                @if (isset($user->image))
    
                    <img class="rounded-full h-48 w-48" src={{ Storage::cloud()->url($user->image->url) }}>
    
                @endif
            </div>
            
            <h2 class="text-lg font-semibold my-4 pt-4">Comments</h2>
            <ul>
                @foreach ($comments as $comment)
                    @if($comment->post->visible)
                    <li>Post ID:<a class="hover:underline"
                            href="{{ route('posts.singlepost', ['post' => $comment->post_id]) }}">{{ $comment->post_id }}
                            -
                            {{ $comment->content }} </a>
                    </li>
                    <br>
                    @endif
                @endforeach
                {{ $comments->links() }}
            </ul>
            @if((Auth::user()->is_admin == 1) && ($user->is_admin == 0))
            <a href="{{route('users.makeadmin', ['user' => $user]) }}"><button
                class="bg-gray-100 rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Make admin</button></a>
            <div class="pb-2"></div>
                @endif
        </div>
    </div>
@endsection
