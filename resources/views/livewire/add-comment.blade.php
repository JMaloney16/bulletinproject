<div>

    <ul>
        @foreach ($comments as $comment)
            <li><a href="{{ route('users.singleuser', ['user' => $comment->user_id]) }}">
                    <span class="text-lg hover:underline">{{ $comment->user->name }}</span>
                </a>
                - {{ $comment->content }}</li>
            @if (Auth::id() == $comment->user_id)
                <button wire:click="editToggle({{ $comment }})">Edit Comment</button>

                <div>
                    @if ($editText && $comment->id === $currentEditComment->id)
                    <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <textarea cols="50" rows="2" name="content" value="{{ old('content') }}"
                            placeholder="Enter a comment here."
                            class="bg-gray-50 border-solid border-black border-2 rounded-md"></textarea>
                        <div class="my-4">
                            <input type="submit" value="Update Comment"
                                class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">
                        </div>
                    </form> 
                    @endif
                </div>
            @endif
        @endforeach
    </ul>
    <div class="pt-2 border-t-2 border-black">
        @auth
            <form>
                @csrf
                <h3 class="text-lg">Enter a comment: </h3>

                <textarea wire:model="message" cols="50" rows="2" name="content" value="{{ old('content') }}"
                    placeholder="Enter a comment here."
                    class="bg-gray-50 border-solid border-black border-2 rounded-md"></textarea>
                <div class="my-4">
                    <input wire:click.prevent="addNewComment()" type="submit" value="Post Comment"
                        class="rounded-lg shadow-md px-2 py-2 border-black hover:bg-white hover:border-2">
                </div>
            </form>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        @endauth
    </div>


</div>
