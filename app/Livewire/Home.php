<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdatePost;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    use WithFileUploads;

    public ?User $usuario = null;

    public $comentario;
    public $comentarioEditado;
    public $comentarioAEditar;
    public $comentarioId;
    public $mostrarModal = false;

    //Update
    public bool $openModalUpdate = false;
    public UpdatePost $form;

    #[On('crearOK')]
    public function render()
    {
        $this->usuario = auth()->user() ?? null;
        $posts = Post::with('user', 'tags')
            ->where('estado', 'PUBLICADO')
            ->orderBy('id', 'desc')
            ->get();

        $postsLikes = ($this->usuario != null) ? $this->usuario->getPostsLikesId() : [];


        $sugerencias = collect(); // Inicializamos como colección vacía
        if ($this->usuario) {
            // Excluir al usuario autenticado y obtener sugerencias
            $sugerencias = User::inRandomOrder()
                ->where('users.id', '!=', $this->usuario->id)
                ->whereNotIn('users.id', $this->usuario->following()->pluck('users.id'))
                ->take(5) // Obtener 5 sugerencias
                ->get();
        }


        $postsSiguiendo = []; // Inicializamos como array vacío
        if ($this->usuario) {
            //post de los usuarios que el usuario autenticado está siguiendo
            $postsSiguiendo = Post::whereIn('user_id', $this->usuario->following()->pluck('users.id'))
                ->where('estado', 'PUBLICADO')
                ->orderBy('id', 'desc')
                ->get();
        }
        //los tags que aparecerán en Home
        $tags = Tag::inRandomOrder()
            ->take(5) // Obtener 5 tags
            ->get();

        //tags usados en update
        $misTags = Tag::select("id", "nombre")->orderBy('nombre')->get();

        return view('welcome', compact('posts', 'postsSiguiendo', 'postsLikes', 'sugerencias', 'tags', 'misTags'));
    }

    /* ---------------------------------- LIKE ---------------------------------- */
    public function like(Post $post)
    {
        $postsLikes = $this->usuario->getPostsLikesId() ?? [];
        if (($key = array_search($post->id, $postsLikes)) != false) {
            unset($postsLikes[$key]);
        } else {
            $postsLikes[] = $post->id;
        }
        $this->usuario->postsLiked()->sync($postsLikes);
    }

    /* ------------------------------- COMENTARIOS ------------------------------ */
    //añadir comentario
    public function comentar(Post $post)
    {
        $this->validate([
            'comentario' => ['required', 'min:1'],
        ]);

        Comment::create([
            'user_id' => $this->usuario->id,
            'post_id' => $post->id,
            'contenido' => $this->comentario,
        ]);

        $this->comentario = '';
    }

    //borrar comentario
    public function borrarComentario(Comment $comment)
    {
        $comment->delete();
    }


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
            'comentarioAEditar' => 'required',
        ]);

        $comentario = Comment::find($this->comentarioId);
        $comentario->update(['contenido' => $this->comentarioEditado]);

        $this->mostrarModal = false;
        $this->comentarioEditado = '';
    }


    /* ------------------------------- BORRAR POST ------------------------------ */
    public function pedirConfirmacion($id)
    {
        $this->dispatch('confirmar', $id);
    }

    #[On('borrarOk')]
    public function borrarPost(Post $post)
    {
        //Comprobamos si borro la imagen
        if (basename($post->imagen) != 'default.png') {
            Storage::delete($post->imagen);
        }
        $post->delete();

        $this->dispatch('mensaje', 'Post Borrado');
    }


    /* ---------------------------------- LIKES --------------------------------- */
    public function getMensajeLikes($postId)
    {
        $post = Post::findOrFail($postId);
        $likesContador = $post->likedByUsers()->count();

        if ($likesContador > 0) {
            $likes = $post->likedByUsers()->take(2)->orderBy('id', 'asc')->get();
            $nombreUsuario = $likes->implode('name', ', ');
            $otrosLikesContador = $likesContador - $likes->count();

            if ($otrosLikesContador > 0) {
                return "Les gusta a $nombreUsuario y $otrosLikesContador otros más";
            } else {
                return "Les gusta a $nombreUsuario";
            }
        }

        return "Aún no hay likes en este post";
    }

    public function getUsuariosLikes($postId)
    {
        $post = Post::findOrFail($postId);
        return $post->likedByUsers()->take(2)->orderBy('id', 'asc')->get();
    }

    /* --------------------------------- UPDATE --------------------------------- */
    // Metodos para update
    public function edit(Post $post)
    {
        $this->form->setPost($post);
        $this->openModalUpdate = true;
    }
    public function update()
    {
        $this->form->actualizar();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Post actualizado');
    }
    public function cancelarUpdate()
    {
        $this->form->limpiar();
        $this->openModalUpdate = false;
    }
}
