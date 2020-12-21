<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CommentController;
use Livewire\Component;

class AddComment extends Component
{
    public $post = '';
    public $comments = [];
    
    public function render()
    {
        return view('livewire.add-comment', [$this->post, $this->comments]);
    }
}
