<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        
        $comments = $post->comments;
        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('posts.create', ['users' => $users]);
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
        $p->user_id = Auth::id();
        $p->save();

        session()->flash('message', 'Post created.');
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
    
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post was deleted');
    }
}
