<div>
    <ul>
        @foreach ($comments as $comment)
            <li>User:<a href="{{ route('users.singleuser', ['user' => $comment->user_id]) }}">{{ $comment->user->name }}</a> - {{ $comment->content }}</li>
        @endforeach
    </ul>
    @auth
    <form>
        @csrf
        <p>Enter a comment: <input wire:model="message" type="text" name="content"
            value="{{ old('content') }}"></p>
            <input wire:click.prevent="addNewComment()" type="submit" value="Post Comment">
    </form>
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    @endauth
</div>
