<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Image; 
use App\Http\Controllers;
use App\Weather;
use Facade\FlareClient\Flare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $weather = app()->make('App\Weather');
        $posts = Post::orderBy('id','desc')->where('visible', 1)->paginate(12);
        return view('posts.index', ['posts' => $posts, 'weather' => $weather->getLocalWeather()]);
    }

    public function searchResults($searchTerm)
    {
        $posts = Post::query()
            ->where('content', 'LIKE', "%{$searchTerm}%")
            ->orWhere('title', 'LIKE', "%{$searchTerm}%")
            ->get();
        return $posts;
    }

    public function show(Post $post)
    {
        $comments = $post->comments;
        $post->vzt()->increment();
        /*
        $viewcount = $post->viewcount;
        $viewcount = $viewcount + 1;
        $post->save();
        */
        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        return view('posts.create', ['post' => $post]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:2000',
            'imagepath' => 'nullable|mimes:jpeg,png,jpg',
        ]);
        /*
        $p = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),
        ])
        */
        $p = new Post;
        $p->title = $validatedData['title'];
        $p->content = $validatedData['content'];
        $p->user_id = Auth::id();
        $p->save();
        if ($request->hasFile('imagepath')) {
            
            $image = new Image;
            $image->url = $request->file('imagepath')->store('public/img/uploaded_images');
            $image->imageable_id = $p->id;
            $image->imageable_type = 'App\Models\Post';
            $image->save();
            
            $p->image()->save($image);
            $p->save();
        }


        session()->flash('message', 'Post created.');
        return redirect()->route('posts.singlepost', [$p]);
    }

    public function update(Post $post, Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'nullable|max:100',
            'content' => 'nullable|max:2000',
            'imagepath' => 'nullable|mimes:jpeg,png,jpg',
        ]);

        $editPost = Post::findOrFail($post->id);

        if (isset($validatedData['title'])) {
            $editPost->title = $validatedData['title'];
        }
        if (isset($validatedData['content'])) {
            $editPost->content = $validatedData['content'];
        }

        if ($request->hasFile('imagepath')) {
            /*
            $image = new Image;
            $image->url = $request->file('imagepath')->store('public/img/uploaded_images');
            $image->imageable_id = $editPost->id;
            $image->imageable_type = 'App\Models\Post';
            $image->save();
            */
            $editPost->image()->update(['url' => $request->file('imagepath')->store('public/img/uploaded_images')]);
            
        }

        $editPost->save();
        session()->flash('message', 'Post has been edited.');
        return redirect()->route('posts.singlepost', [$post]);
    }

    public function toggleVisibility(Post $post)
    {
        if(!$post->visible) {
            $post->visible = True;
        }elseif($post->visible) {
            $post->visible = False;
        }

        $post->save();

        return redirect()->route('admin.view')->with('message', 'Visibility updated');
    }

    public function destroy(Post $post)
    {

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post was deleted');
    }
}
