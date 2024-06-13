<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikePost extends Component
{
    public function render()
    {
        return view('livewire.like-post');
    }

    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }


    public function like()
    {
        // Obtenemos el ID del usuario autenticado
        $userId = auth()->id();

        // Verificamos si el usuario ha dado like en el post
        if ($this->post->likedByUsers()->where('user_id', $userId)->exists()) {
            // Si el usuario ha dado like, lo eliminamos desvinculándolo del post
            $this->post->likedByUsers()->detach($userId);
        } else {
            // Si el usuario no ha dado like, lo agregamos vinculándolo al post
            $this->post->likedByUsers()->attach($userId);
        }

        // Actualizamos la relación post->likedByUsers
        $this->post->refresh();
    }
}
