<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Vote;
use App\Models\User;
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

    public function close(Election $election)
    {
        $candidates = $election->candidates();
        $topVoted = $candidates->first();

        $candidates->each(function ($candidate) use (&$topVoted) {
            if ($candidate->votes()->count() > $topVoted->votes()->count()) {
                $topVoted = $candidate;
            }
        });

        $previousAdmins = User::where('is_admin', 1);
        $previousAdmins->each(function ($admin) {
            $admin->is_admin = 0;
            $admin->save();
        });

        $topVoted->user->is_admin = 1;
        $topVoted->user->save();

        $election->open = 0;
        $election->save();

        session()->flash('message', 'Election has been closed.');
        return redirect()->route('elections.index');
    }

}
