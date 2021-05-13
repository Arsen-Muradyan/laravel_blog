@props(['post' => $post])
<div class="mb-4">
    <!-- Post data -->
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }} </a><span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>
    <!-- Post Delete -->
    @auth
        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf
                @method("DELETE")
                <button type="submit" class="text-blue-500">Delete</button>
            </form>
    @endcan
@endauth
<!-- Likes -->
    <div class="flex items-center">
        @auth
            @if($post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="text-blue-500" type="submit">Unlike</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button class="text-blue-500" type="submit">Like</button>
                </form>
            @endif
        @endauth
        <span>{{ $post->likes->count() }} {{ \Illuminate\Support\Str::plural("like", $post->likes->count()) }}</span>
    </div>
</div>
