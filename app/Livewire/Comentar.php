<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comentar extends Component
{
    public $comentario;
    public $postId;

    public $comentarioEditado;
    public $comentarioAEditar;
    public $comentarioId;
    public $mostrarModal = false;


    public function render()
    {
        $miPost = Post::find($this->postId); //Cargar el post con los comentarios
        return view('livewire.comentar', compact('miPost'));
    }

    public function comentar()
    {
        $this->validate([
            'comentario' => ['required', 'min:1'],
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->postId,
            'contenido' => $this->comentario,
        ]);

        $this->comentario = '';
    }
    public function borrarComentario(Comment $comment)
    {
        $comment->delete();
    }

    ////////////////////
    public function editarComentario($comentarioId)
    {
        $this->comentarioId = $comentarioId;
        $this->comentarioAEditar = Comment::find($comentarioId);
        $this->comentarioEditado = $this->comentarioAEditar->contenido;
        $this->mostrarModal = true;
    }



    public function actualizarComentario()
    {
        $this->validate([
            'comentarioAEditar' => ['required', 'min:1'],
        ]);

        $comentario = Comment::find($this->comentarioId);
        $comentario->update(['contenido' => $this->comentarioEditado]);

        $this->mostrarModal = false;
        $this->comentarioEditado = '';
    }
}
