<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $followingUsers = User::all();
        return view('chat.index', compact('followingUsers'));
    }

    public function chat($id)
    {
        $user = User::findOrFail($id);
        return view('chat.inbox', compact('id'));
    }
}
