<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PostController;
use Livewire\Component;

class SearchPosts extends Component
{
    public $search = 'hello world';

    public function render()
    {
        
        return view('api.posts.searchresults', [$this->search]);
    }
}
