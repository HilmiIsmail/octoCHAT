<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdatePost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;
    public $postsLikes;
    public $otrosPosts;


    //Update
    public bool $modalUpdate = false;
    public UpdatePost $form;

    public function mount(Post $post)
    {
        $this->post = $post;

        // Verificar si el post es ARCHIVADO y no pertenece al usuario actual
        if ($this->post->estado === 'ARCHIVADO' && $this->post->user_id !== Auth::id()) {
            abort(403);
        }

        $this->postsLikes = $this->post->likedByUsers()->pluck('users.id')->toArray();

        // Obtener otros posts del mismo usuario, menos el post actual
        $this->otrosPosts = Post::inRandomOrder()
            ->where('user_id', $this->post->user_id)
            ->where('id', '!=', $this->post->id)
            ->take(3)
            ->get();
    }

    public function actualizarDisponibilidad()
    {
        $this->post->estado = ($this->post->estado == 'PUBLICADO') ? 'ARCHIVADO' : 'PUBLICADO';
        $this->post->save();
    }
    #[On('post-editado')]
    public function render()
    {
        //tags usados en update
        $misTags = Tag::select("id", "nombre")->orderBy('nombre')->get();

        return view('livewire.show-post', [
            'post' => $this->post,
            'postsLikes' => $this->postsLikes,
            'otrosPosts' => $this->otrosPosts,
        ], compact('misTags'));
    }


    /* ------------------------------- BORRAR POST ------------------------------ */
    public function pedirConfirmacion($id)
    {
        //dd($id);
        $this->dispatch('confirmacionBorrar', $id);
    }

    #[On('borrado')]
    public function borrarPost(Post $post)
    {
        //Comprobamos si borro la imagen
        if (basename($post->imagen) != 'default.png') {
            Storage::delete($post->imagen);
        }
        $post->delete();
        //$this->dispatch('mensaje', 'Post Borrado');

        // Redirect to the profile page
        return redirect()->route('perfil.show')->with('mensaje', 'Post Borrado');
    }

    /* --------------------------------- UPDATE --------------------------------- */
    // Metodos para update
    public function edit(Post $post)
    {

        $this->form->setPost($post);
        $this->modalUpdate = true;
    }
    public function update()
    {
        $this->form->actualizar();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Post actualizado');
        $this->dispatch('post-editado')->to(ShowPost::class);
    }
    public function cancelarUpdate()
    {
        $this->form->limpiar();
        $this->modalUpdate = false;
    }
}
