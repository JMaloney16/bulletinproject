@extends('layouts.test')

@if(@isset($post))
@section('title', 'Edit Post')
@else
@section('title', 'Create Post')
@endif

@section('content')
    <div class="max-w-xl bg-white rounded-lg shadow-lg py-10 px-5 m-auto w-full mt-10">
        
        @if(isset($post))
        <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
        @else
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @endif
            @csrf
            <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
                <h1 class="font-semibold text-xl leading-tight">Please note posts will not be public until approved by an administrator</h1>
                <div class="col-span-2">
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Title"
                        class="rounded-lg border-solid border-gray-200 border-2 p-3 md:text-xl w-full" />
                </div>
                <div class="col-span-2">
                    <input type="file" name="imagepath" value="{{ old('imagepath') }}" placeholder="Imagepath"
                        class="rounded-lg border-solid border-gray-200 border-2 p-3 md:text-xl w-full" />
                </div>
                <div class="col-span-2">

                    <textarea cols="30" rows="8" name="content" value="{{ old('content') }}"
                        placeholder="Enter your message here"
                        class="rounded-lg border-solid border-gray-200 border-2 p-3 md:text-xl w-full"></textarea>
                </div>

                <input type="submit" value="Submit"
                    class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">
                @if(isset($post))
                    {{-- <a href="{{ route('posts.singlepost', [$post]) }}"> --}}
                @else
                    <a href="{{ route('posts.index') }}">
                @endif
                        <span
                        class="bg-gray-100 rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Cancel</span></a>
                
            </div>
        </form>
    </div>
@endsection
