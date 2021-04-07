@extends('layouts.test')

@section('title', 'Election Voting')

@section('headerBar')

@section('content')
<?php $candidates = $election->candidates; ?>

<div class="max-w-xl bg-white rounded-lg shadow-lg py-10 px-5 m-auto w-full mt-10">
    <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
    <label class="col-span-2">Candidates</label>
    <form method="POST" action="{{ route('elections.store', ['election' => $election]) }}" enctype="multipart/form-data">
    @foreach ($candidates as $candidate)
        
            @csrf
                <div class="col-span-2 my-4">
                    <input type="radio" value={{ $candidate->id }} id={{ $candidate->id }} name="candidates">
                    <label for={{ $candidate->id }}>{{$candidate->user->name}}</label>
                </div>
                @endforeach
            <input type="submit" value="Submit Vote"
                class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">

            </form>
        </div>
</div>

@endsection