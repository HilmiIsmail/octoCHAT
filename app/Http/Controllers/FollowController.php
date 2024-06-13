<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $follow = auth()->user();
        $follow->following()->attach($user);
        return redirect()->route('perfil.user', $user->id)
            ->with('mensaje', 'Ahora estás siguiendo a ' . $user->name);
    }

    public function unfollow(User $user)
    {
        $unfollow = auth()->user();
        $unfollow->following()->detach($user);
        return redirect()->route('perfil.user', $user->id)
            ->with('mensaje', 'Dejaste de seguir a ' . $user->name);
    }
}
