@extends('layouts.test')

@section('title', 'Create Post')
    
@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>Title: <input type="text" name="title" 
            value="{{ old('title') }}"></p>
        <p>Content: <input type="text" name="content"
            value="{{ old('content') }}"></p>
        <p>Image: <input type="text" name="imagepath"
            value="{{ old('imagepath') }}"></p>
        <p>User: 
            <select name="userid">
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    @if ($user->id == old('userid'))
                        selected="selected"
                    @endif
                >{{ $user->name }}</option>
                @endforeach
            </select>
        </p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.index')  }}">Cancel</a>
    </form>

@endsection