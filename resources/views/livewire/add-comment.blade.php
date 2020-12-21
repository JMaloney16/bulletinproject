<div>
    <ul>
        @foreach ($comments as $comment)
            <li>User:<a href="{{ route('users.singleuser', ['user' => $comment->user_id]) }}">{{ $comment->user->name }}</a> - {{ $comment->content }}</li>
        @endforeach
    </ul>
    
    <form method="POST" action="{{ route('comments.store', ['post' => $post]) }}">
        @csrf
        <p>Enter a comment: <input type="text" name="content"
            value="{{ old('content') }}"></p>
        <input type="submit" value="Post Comment">
    </form>
    
</div>
