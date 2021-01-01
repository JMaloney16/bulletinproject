<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Comment;
Use App\Models\User;
Use App\Models\Post;
use App\Events\CommentPosted;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $validatedData = $request->validate([
            'content' => 'required|max:250'
        ]);

        $c = new Comment;
        $c->content = $validatedData['content'];
        $c->post_id = $post->id;
        $c->user_id = Auth::id();
        $c->save();

        session()->flash('message', 'Comment posted.');
        broadcast(new CommentPosted(Auth::user(), $c->content))->toOthers();

        return redirect()->route('posts.singlepost', [$post]);
    }

    public function update(Request $request, Comment $comment){
        $validatedData = $request->validate([
            'content' => 'required|max:250'
        ]);

        $comment->content = $validatedData['content'];
        $comment->save();
        session()->flash('message', 'Comment edited.');
        return redirect()->route('posts.singlepost', [$comment->post]);
    }
}
