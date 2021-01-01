<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class EditComment extends Component
{

    public $comment, $message;
    public $editText = false;
    

    protected $listeners = [
        'commentRefresh' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.edit-comment', [$this->comment]);
    }

    public function editToggle(){
        $this->editText = !$this->editText;
    }

    public function editComment(){
        $this->validate(
            [
                'message' => 'required|max:250'
            ],
        );
        
        $this->comment->content = $this->message;
        $this->comment->save();
        
        $this->message = "";

        $this->emit('commentRefresh');
        session()->flash('message', 'Comment Edited.');
    }
}
