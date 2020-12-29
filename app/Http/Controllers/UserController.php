<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        
        
        $comments = Comment::where('user_id', '=', $user->id)->paginate(10);
        return view('users.show', ['user' => $user, 'comments' => $comments]);
    }

    public function adminView(){
        return view('admin-view');
    }

}
