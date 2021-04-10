@extends('layouts.test')

@section('title', 'Election Voting')

@section('headerBar')

@section('content')
<div class="max-w-xl bg-white rounded-lg shadow-lg py-10 px-5 m-auto w-full mt-10">
{{-- @if ((Auth::user()->is_admin == 1) && ($election->open == true))
    <form method="POST" action="#" enctype="multipart/form-data">
        <div class="grid py-4">

            @foreach ($users as $user)
            <div>
                <input type="checkbox" id={{$user->id}} name={{$user->id}} value={{$user->name}}>
                <label for={{$user->id}}> {{$user->name}} </label>
            </div>
            @endforeach
            <input type="submit" value="Add Candidates"
            class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">
        </div>
</form>
@endif --}}

<?php $candidates = $election->candidates; ?>
    @if(!$candidates->contains('user', Auth::User()))
    <a href="{{route('elections.adduser', ['election' => $election]) }}"><span
        class="bg-gray-100 rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Run for election</span></a>
    @endif
    <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
        @if ($election->open == false)
            <label class="col-span-2">Election closed</label>
            @foreach ($candidates as $candidate)
            <div>
                <label>{{ $candidate->user->name }}: {{$candidate->votes()->count() }} votes</label>    
            </div>    
            @endforeach
        @endif
    <label class="col-span-2">Candidates</label>
    <form method="POST" action="{{ route('elections.store', ['election' => $election]) }}" enctype="multipart/form-data">
    @foreach ($candidates as $candidate)
        
            @csrf
                <div class="col-span-2 my-4">
                    <input type="radio" value={{ $candidate->id }} id={{ $candidate->id }} name="candidates">
                    <label for={{ $candidate->id }}>{{$candidate->user->name}}</label>
                </div>
    @endforeach
            @if ($election->open == true)
                <input type="submit" value="Submit Vote"
                class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">
            @endif
            </form>
            @if ((Auth::user()->is_admin == 1) && ($election->open == true))
                            <form method="POST" action="{{ route('elections.close', ['election' => $election]) }}">
                                @csrf
                                <button type="submit"
                                    class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">Close</button>
                            </form>
            @endif
        </div>
</div>

@endsection