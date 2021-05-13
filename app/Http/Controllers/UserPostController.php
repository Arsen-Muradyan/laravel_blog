<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
class UserPostController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->orderBy("created_at", 'desc')->with(['user', 'likes'])->paginate(20);
        return view("users.posts.show", [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
