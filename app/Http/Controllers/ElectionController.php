<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::orderBy('created_at','desc')->paginate(10);
        return view('elections.index', ['elections' => $elections]);
    }

    public function vote(Election $election)
    {
        return view('elections.vote', ['election' => $election]);
    }


}
