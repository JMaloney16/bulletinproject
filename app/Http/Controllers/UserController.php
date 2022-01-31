<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        $comments = Comment::where('user_id', '=', $user->id)->paginate(10);
        return view('users.show', ['user' => $user, 'comments' => $comments]);
    }

    public function adminView(){
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('admin-view', ['posts' => $posts]);
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = 1;
        $user->save();

        session()->flash('message', 'User has been made admin.');
        return redirect()->route('users.singleuser', ['user' => $user]);
    }

}
