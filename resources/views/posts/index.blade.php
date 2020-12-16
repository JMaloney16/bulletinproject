@extends('layouts.test')

@section('title', 'Posts')

@section('content')

    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            <div class="ny-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
            @foreach ($posts as $post)
            <?php $user = $post->user ?>
                <article class="overflow-hidden rounded-lg shadow-lg">
                    @if(isset($post->imagepath))
                        <a href="#">
                            <img class="block h-auto w-full" src={{ $post->imagepath }}>
                        </a>
                    @endif
                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">    
                            <a class="no-underline hover:underline text-black" href="{{ route('posts.singlepost', [$post]) }}">{{ $post->title }}</a>
                        </h1>
                        <p class="text-grey-darker text-sm">
                            {{ $post->created_at->toDateString() }}
                        </p>
                    </header>
                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <a class="flex items-center no-underline hover:underline text-black" href="#">
                            @if(isset($user->profile_photo_path))
                            <img alt={{ $user->name}}"'s Profile Picture'" class="block rounded-full" src={{$user->profile_photo_path}}>
                            @endif
                            <a class="ml-2 text-sm" href=" {{ route('users.singleuser', [$user]) }}">
                                {{$user->name}}
                            </a>
                        </a>
                    </footer>
                </article>
            @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('posts.create') }}">Create Post</a>
    {{ $posts->links() }}
@endsection

