@extends('layouts.test')

@section('title', 'Admin View')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="container bg-white rounded-lg shadow-lg my-6 pb-4 mx-auto px-4 justify-center md:px-8">
                  @foreach ($posts as $post)
                  <div class="container bg-grey-100 rounded-lg shadow-lg my-4 mx-auto px-4">      
                     <h2>
                            <a href="{{ route('posts.singlepost', [$post]) }}">
                            {{ $post->title }} : View Count - {{ $post->vzt()->count() }} : Visible - {{ $post->visible }}
                            </a>
                            <form method="POST" action="{{ route('posts.destroy', [$post]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Delete</button>
                            </form>
                            <a href="{{ route('posts.togglevis', ['post' => $post]) }}">
                                <span
                                class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Toggle Visibility</span>
                            </a>
                    </h2>
                  </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
                
        </div>
    </div>
</div>
@endsection