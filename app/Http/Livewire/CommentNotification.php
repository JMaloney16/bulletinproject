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
    public $thisUser;
    public $post;

    protected $listeners = [
        'echo-private:commentNotification,CommentPosted' => 'notifyNewComment',
    ];

    public function render()
    {
        $this->thisUser = Auth::id();
        return view('livewire.comment-notification');
    }

    public function notifyNewComment($event)
    {
        
        $user = User::find($event['user']['id']);
        $comment = Comment::find($event['comment']['id']);
        
        $this->post = Post::find($comment->post_id);
        
        if ($this->thisUser === $this->post->user->id){

            $this->notification = $user->name.' commented on your post: '.$this->post->title;
        }
    }
}
