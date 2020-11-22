@extends('layouts.test')

@section('title', 'Users')

@section('content')
    <p>Users on the network:</p>
    <ul>
        @foreach ($users as $user)
            <li><a href="{{ route('users.singleuser', ['id' => $user->id]) }}">{{ $user->name }}</a></li>
        @endforeach
    </ul>
@endsection     