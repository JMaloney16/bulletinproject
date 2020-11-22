<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request){
        //dd($request['title']);
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:2000',
            'imagepath' => 'nullable'
        ]);
        
        $p = new Post;
        $p->title = $validatedData['title'];
        $p->content = $validatedData['content'];
        $p->imagepath = $validatedData['imagepath'];
        $p->user_id=1;
        $p->save();

        session()->flash('message', 'Post created.');
        return redirect()->route('posts.index');
    }
}
