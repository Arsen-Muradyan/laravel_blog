<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $posts = Post::with(['user'])->orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function show(Post $post)
    {
        return view("posts.show", [
            'post' => $post
        ]);
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'body' => 'required'
        ]);
        auth()->user()->posts()->create([
            'body' => $request->body
        ]);
        return back()->with('status', 'Post Created Successfuly');
    }
    public function destroy(Post $post) {
        $this->authorize('delete',  $post);
        $post->delete();
        return back()->with('status', 'Post Deleted Successfuly');
    }
}
