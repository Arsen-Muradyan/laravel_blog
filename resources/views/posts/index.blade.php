@extends('layouts.app')
@section('content')
  <div class="flex justify-center">
    <div class="w-8/12  bg-white p-6 rounded-lg">
        @if (session('status'))
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 mb-3 relative" role="alert" id="info-alert-bar">
                <p class="font-bold">Informational message</p>
                <p class="text-sm">{{ session('status') }}</p>
                <button onclick="closeInfoBar(event)" class="absolute top-0 bottom-0 right-0 px-4 py-3" >
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </button>
            </div>
        @endif
        @auth
            <!-- New Post Form -->
            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                <textarea name="body" placeholder="Post Something!" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium my-3">Post</button>
            </form>
        @endauth
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
  <script>
      function closeInfoBar(e) {
          document.getElementById('info-alert-bar').style.display = 'none';
      }
  </script>
@endsection
