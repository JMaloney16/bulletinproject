<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class CommentNotification extends Component
{
    public $notification = '';

    protected $listeners = [
        'echo-private:commentNotification,CommentPosted' => 'notifyNewComment',
    ];

    public function render()
    {
        return view('livewire.comment-notification');
    }

    public function notifyNewComment($event)
    {
        $user = User::find($event['user']['id']);
        $comment = Comment::find($event['comment']['post_id']);
        
        $post = Post::find($comment->post_id);
        
        $this->notification = $user->name.' posted: '.$comment->content;
        if (Auth::id() == $post->user->id){
            
            dd($event);
        }
    }
}
