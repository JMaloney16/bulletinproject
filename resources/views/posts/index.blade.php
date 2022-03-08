@extends('layouts.test')

@section('title', 'Posts')

@section('headerBar')

<a href="{{ route('posts.create') }}"><span
    class="bg-gray-100 rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Create Post</span></a>
@endsection

@section('content')

    <div class="container my-12 mx-auto justify-center">
        
        <div class="flex flex-wrap justify-center my-1 lg:my-4">
            @foreach ($posts as $post)
                <?php $user = $post->user; ?>
                <div class="mx-2 pb-2 lg:w-1/3">
                    <article class="overflow-hidden bg-white rounded-lg shadow-lg">
                        @if (isset($post->image))
                            <a href="{{ route('posts.singlepost', [$post]) }}">
                                <img class="block h-auto w-full object-cover" src={{ Storage::cloud()->url($post->image->url) }}>
                            </a>
                        @endif
                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a class="no-underline hover:underline text-black"
                                    href="{{ route('posts.singlepost', [$post]) }}">{{ $post->title }}</a>
                            </h1>
                            <p class="text-grey-darker text-sm">
                                {{ $post->created_at->toDateString() }}
                            </p>
                        </header>
                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <a class="flex items-center no-underline hover:underline text-black" href="{{ route('users.singleuser', [$user]) }}">
                                @if (isset($user->image))
                                    <img alt={{ $user->name }}"'s Profile Picture'"
                                        class="block rounded-full hover:opacity-75 h-8 w-8" src={{ Storage::cloud()->url($user->image->url) }}>
                                @endif
                                <a class="ml-2 text-sm" href="{{ route('users.singleuser', [$user]) }}">
                                    {{ $user->name }}
                                </a>
                            </a>
                        </footer>
                    </article>
                </div>
            @endforeach
            <div class="my-6">
            {{ $posts->links() }}
            </div>
        </div>
        <div class="mx-auto text-center">
            
                <span class="mx-2">{{ $weather['name'] }}</span>
                <span class="mx-2">{{ $weather['weather']['0']['main'] }}</span>
                <span class="mx-2">Temp (Celsius): {{$weather['main']['temp']}}</span>
                
        </div>
    </div>

@endsection
