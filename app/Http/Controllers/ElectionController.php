<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function store(Election $election, Request $request)
    {
        $user = Auth::user();
        $pastVotes = $user->votes;
        // dd($request->input());
        $v = new Vote;
        $v->user_id = Auth::id();
        $v->candidate_id = $request->input('candidates');
        $v->save();
        $pastVotes->each(function ($vote) use ($election) {
            if ($election == $vote->election()) {
                $vote->delete();
            }
        });
        
        session()->flash('message', 'Vote submitted.');
        return redirect()->route('elections.index');
    }

}