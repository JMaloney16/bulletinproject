@extends('layouts.test')

@section('title', 'Election Voting')

@section('headerBar')

@section('content')
<?php $candidates = $election->candidates; ?>

<div class="max-w-xl bg-white rounded-lg shadow-lg py-10 px-5 m-auto w-full mt-10">
    <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
    <label>Candidates</label>
    @foreach ($candidates as $candidate)
        
        <form method="POST" action="#" enctype="multipart/form-data">
            @csrf
                <div class="col-span-2">
                    <input type="radio" value={{ $candidate->id }} id={{ $candidate->id }} name="candidates">
                    <label for={{ $candidate->id }}>{{ $candidate->user->name}}</label>
                </div>
            </form>
            @endforeach
        </div>
</div>

@endsection