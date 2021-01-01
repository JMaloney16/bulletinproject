<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CommentController;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class AddComment extends Component
{
    public $post, $message;
    public $comments = [];
    public $editText = false;
    
    

    protected $listeners = [
        'commentSectionRefresh' => '$refresh',
    ];
    
    public function render()
    {
        $this->comments=$this->post->comments;
        return view('livewire.add-comment', [$this->post, $this->comments]);
    }

    public function editToggle(){
        
        $this->editText = !$this->editText;
    }
    
    public function addNewComment(){
        $this->validate(
            [
                'message' => 'required|max:250'
            ],
        );

        $newComment = new Comment();
        $newComment->content = $this->message;
        $newComment->post_id = $this->post->id;
        $newComment->user_id = Auth::id();
        $newComment->save();
        $this->message = "";
        
        $this->emit('commentSectionRefresh');
        session()->flash('message', 'Comment posted.');
    }

    
    
    
}
