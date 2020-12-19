@extends('layouts.test')

@section('title', 'Create Post')

@section('content')
    <div class="max-w-xl bg-white py-10 px-5 m-auto w-full mt-10">
        
        <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
        <div class="col-span-2 lg:col-span-1">
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Title" class="border-solid border-gray-400 border-2 p-3 md:text-xl w-full" />
        </div>
        <div class="col-span-2 lg:col-span-1">
            <input type="text" name="imagepath" value="{{ old('imagepath') }}" placeholder="Imagepath" class="border-solid border-gray-400 border-2 p-3 md:text-xl w-full"/>
        </div>
        <div class="col-span-2">

            <textarea cols="30" rows="8" name="content" value="{{ old('content') }}" placeholder="Enter your message here" class="border-solid border-gray-400 border-2 p-3 md:text-xl w-full"></textarea>
        </div>
        
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
        </div>
    </form>
    </div>
@endsection
