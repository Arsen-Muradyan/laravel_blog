<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.register');
    }
    public function store(Request $request) {
        $request->validate([
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'password' => 'required|confirmed',
            'email' => 'required|max:255|email|unique:users'
        ]);
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('dashboard');
    }
}
