@extends('layouts.test')

@section('title', 'Posts')

@section('headerBar')
<a href="{{ route('posts.create') }}"><span
    class="bg-gray-100 rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Create Post</span></a>
@endsection

@section('content')

    <div class="container my-12 mx-auto px-4 justify-center md:px-8">
        
        <div class="flex flex-wrap justify-center my-1 lg:my-4">
            @foreach ($posts as $post)
                <?php $user = $post->user; ?>
                <div class="mx-2 pb-2 lg:w-1/3">
                    <article class="overflow-hidden rounded-lg shadow-lg">
                        @if (isset($post->image))
                            <a href="{{ route('posts.singlepost', [$post]) }}">
                                <img class="block h-auto w-full" src={{ Storage::url($post->image->url) }}>
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
                            <a class="flex items-center no-underline hover:underline text-black" href="#">
                                @if (isset($user->image))
                                    <img alt={{ $user->name }}"'s Profile Picture'"
                                        class="block rounded-full hover:opacity-75 h-8 w-8" src={{ Storage::url($user->image->url) }}>
                                @endif
                                <a class="ml-2 text-sm" href=" {{ route('users.singleuser', [$user]) }}">
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
    </div>

@endsection
