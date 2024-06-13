<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class UpdatePost extends Form
{
    use WithFileUploads;

    public ?Post $post = null;
    public string $contenido = "";
    public ?string $estado = null;
    public $imagen;
    public array $tags = [];

    public function setPost(Post $post)
    {
        //dd($post->id);
        $this->post = $post;
        $this->contenido = $post->contenido;
        $this->estado = $post->estado;
        $this->tags = $post->getTagsId();
    }

    public function rules(): array
    {
        return [
            'contenido' => ['required', 'string', 'min:10'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'tags' => ['required', 'array', 'min:1', 'exists:tags,id'],
            'estado' => ['nullable'],
        ];
    }

    public function actualizar()
    {
        $this->validate();

        $ruta = $this->post->imagen;
        if ($this->imagen) {
            if (basename($this->post->imagen) != 'default.png') {
                Storage::delete($this->post->imagen);
            }
            $ruta = $this->imagen->store('public/posts');
        }
        //Actualiza Post
        $this->post->update([
            'contenido' => $this->contenido,
            'imagen' => $ruta,
            'estado' => ($this->estado) ? "PUBLICADO" : "ARCHIVADO",
        ]);
        //Actualiza sus etiquetas
        $this->post->tags()->sync($this->tags);
        //$this->limpiar();

    }

    public function limpiar()
    {
        $this->reset(['post', 'contenido', 'tags', 'imagen', 'estado']);
    }
}
