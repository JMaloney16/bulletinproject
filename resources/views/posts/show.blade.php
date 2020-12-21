@extends('layouts.test')

@section('title', 'Post Details')

@section('content')
    <div class="px-4 md:px-12">
        <div class="container bg-white rounded-lg shadow-lg my-6 mx-auto px-4 justify-center md:px-8">
            <h1 class="text-xl font-bold my-6 pt-6">{{ $post->title }}</h1>
            @if (!empty($post->imagepath))
                <img class="mx-auto rounded-lg shadow-lg my-4" src={{ $post->imagepath }}>
            @endif
            <div class="bg-gray-100 rounded-md shadow-md">
                <div class="mx-2 my-2 py-2">{{ $post->content }} <br><br>
                    Imagepath: {{ $post->imagepath ?? 'n/a' }}
                </div>

            </div>
            <h2 class="text-lg font-semibold my-4 pt-4">Comments</h2>
            <div class="bg-gray-100 rounded-lg shadow-md">
                <div class="mx-2 py-2">
                    @livewire('add-comment', ['post' => $post,'comments' => $comments])
                    <div class="flex justify-between">
                        @if (Auth::id() == $post->user->id || (Auth::check() && Auth::user()->is_admin == 1))
                            <form method="POST" action="{{ route('posts.destroy', [$post]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Delete</button>
                            </form>
                        @endif
                        <a href="{{ route('posts.index') }}">
                            <span
                                class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
