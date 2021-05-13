<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function store(Post $post)
    {
        $user = auth()->user();
        if ($post->likedBy($user)) {
            return response(null, 409);
        }
        $post->likes()->create([
            'user_id' => $user->id
        ]);
        if (!$post->likes()->onlyTrashed()->where('user_id', auth()->user()->id)->count()) {
            Mail::to($post->user)->send(new PostLiked($user, $post));
        }

        return back();
    }
    public function destroy(Post $post) {
        auth()->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }

}
