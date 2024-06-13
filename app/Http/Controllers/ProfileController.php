<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ProfileController extends Controller
{
    use WithPagination;

    public $followers = [];
    public $following = [];

    public function show()
    {
        $user = auth()->user() ?? null;
        $posts = Post::where('user_id', $user->id)->orderBy('id', 'desc')->get(); // Obtener los posts del usuario autenticado
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        return view('profile.profile', compact('user', 'posts', 'followersCount', 'followingCount'));
    }

    public function showUser(User $user)
    {
        $posts
            = $user->posts()->where('estado', 'PUBLICADO')->orderBy('id', 'desc')->get();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        return view('profile.profile', compact('user', 'posts', 'followersCount', 'followingCount'));
    }

    public function likes()
    {
        $postsLikes = auth()->user()->postsLiked()->where('estado', 'PUBLICADO')
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('profile.misLikes', compact('postsLikes'));
    }
}
