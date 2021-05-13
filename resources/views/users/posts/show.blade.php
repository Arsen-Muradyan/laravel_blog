@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium">{{ $user->name }}</h1>
                <p>Posted {{ $posts->count() }} {{ \Illuminate\Support\Str::plural('post', $posts->count()) }} and recived {{ $user->recivedLikes->count() }} {{ \Illuminate\Support\Str::plural('like',  $user->recivedLikes()->count()) }}</p>
            </div>
            <div class="bg-white  p-6 rounded-lg">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <x-post :post="$post"></x-post>
                    @endforeach
                    {{ $posts->links()  }}
                @else
                    Don't Have Posts
                @endif
            </div>
        </div>

    </div>
@endsection
