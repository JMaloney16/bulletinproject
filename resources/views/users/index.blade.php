@extends('layouts.test')

@section('title', 'Users')

@section('content')
    <div class="container my-12 mx-auto px-4 justify-center md:px-8">
        <h1 class="text-xl font-bold">Users on the network:</h1>
        <div class="grid md:grid-cols-2 justify-center my-1 rounded-lg lg:my-4">
            @foreach ($users as $user)
                <div class="mx-2 pb-2">
                    <article class="overflow-hidden rounded-lg shadow-lg">
                        @if (isset($user->image))
                            <a href="{{ route('users.singleuser', [$user]) }}">
                                <img class="block h-auto w-full" src={{ Storage::url($user->image->url) }}>
                            </a>
                        @endif
                        <header class="flex leading-tight p-2 md:p-4 bg-white">
                            <h1 class="text-lg">
                                <a href="{{ route('users.singleuser', [$user]) }}">{{ $user->name }}</a>
                            </h1>
                        </header>
                    </article>
                </div>
            @endforeach
            </ul>
        </div>
        {{ $users->links() }}
    </div>
@endsection
