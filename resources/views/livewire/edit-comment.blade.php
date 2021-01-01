<div>
    <li><a href="{{ route('users.singleuser', ['user' => $comment->user_id]) }}">
            <span class="text-lg hover:underline">{{ $comment->user->name }}</span>
        </a>
        - {{ $comment->content }}</li>
    @if (Auth::id() == $comment->user_id)
        <button wire:click="editToggle">Edit Comment</button>
        <div>
            @if ($editText)
                <form>
                    @csrf
                    <textarea wire.model="message" cols="50" rows="2" name="content" value="{{ old('content') }}"
                        placeholder="Enter a comment here."
                        class="bg-gray-50 border-solid border-black border-2 rounded-md"></textarea>
                    <div class="my-4">
                        <input wire:click="editComment($comment)" type="submit" value="Update Comment"
                            class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">
                    </div>
                </form>
            @endif
        </div>
    @endif
</div>
