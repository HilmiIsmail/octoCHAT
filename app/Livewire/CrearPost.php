<?php

namespace App\Livewire;

use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearPost extends Component
{
    use WithFileUploads;
    public bool $openCrear = false;

    #[Validate(['required', 'string', 'min:10'])]
    public string $contenido;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['nullable'])]
    public string $estado = "";

    #[Validate(['required', 'array', 'min:1', 'exists:tags,id'])]
    public array $tags = [];

    public function render()
    {
        $misTags = Tag::select('id', 'nombre')->orderBy('nombre')->get();
        return view('livewire.crear-post', compact('misTags'));
    }

    //CREAR UN NUEVO POST
    public function store()
    {
        $this->validate();
        $post = Post::create([
            'contenido' => $this->contenido,
            'estado' => ($this->estado) ? "PUBLICADO" : "ARCHIVADO",
            'imagen' => ($this->imagen) ? $this->imagen->store('public/posts') : 'default.png',
            'user_id' => auth()->user()->id,
        ]);

        //le añado a la pelicula recien creada sus etiquetas
        $post->tags()->attach($this->tags);


        //Avisamos al welcome para que se actualiza y aparezca la pelicula creda
        $this->dispatch('crearOK')->to(Home::class);

        $this->dispatch('mensaje', 'Post creado con éxito');
        $this->limpiarCrear();
    }

    public function limpiarCrear()
    {
        $this->reset(['openCrear', 'contenido', 'estado', 'imagen', 'tags']);
    }
}
