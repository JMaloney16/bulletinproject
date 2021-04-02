@extends('layouts.test')

@section('title', 'Elections')

@section('headerBar')

@endsection

@section('content')

<div class="flex flex-wrap justify-center my-1 lg:my-4">
    <div class="flex flex-wrap justify-center my-1 lg:my-4">
        @foreach ($elections as $election)
            <div class="mx-2 pb-2 lg:w-1/3">
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            <a class="no-underline hover:underline text-black"
                                href="{{route ('elections.vote', $election) }}">{{ $election->created_at }}</a>
                        </h1>
                        <p class="text-grey-darker text-sm">
                            {{ $election->created_at->toDateString() }}
                        </p>
                    </header>
                </article>
            </div>
        @endforeach
    </div>
</div>

@endsection