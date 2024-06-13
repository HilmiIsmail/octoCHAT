<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class ManageTags extends Component
{
    public $tags;
    public $nombre;
    public $tagId;
    public $updateMode = false;

    protected $rules = [
        'nombre' => ['required', 'min:3', 'unique:tags,nombre'],
    ];

    public function render()
    {
        $this->tags = Tag::orderBy('id', 'desc')->get();
        return view('livewire.manage-tags');
    }

    public function resetInput()
    {
        $this->nombre = '';
        $this->tagId = '';
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();
        Tag::create(['nombre' => $this->nombre]);
        $this->dispatch('mensaje', 'Tag creado con éxito');
        $this->resetInput();
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $this->tagId = $id;
        $this->nombre = $tag->nombre;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => ['required', 'min:3', 'unique:tags,nombre,' . $this->tagId],
        ]);

        $tag = Tag::find($this->tagId);
        $tag->update(['nombre' => $this->nombre]);
        $this->dispatch('mensaje', 'Tag actualizado con éxito');
        $this->resetInput();
    }

    public function delete($id)
    {
        Tag::find($id)->delete();
        $this->dispatch('mensaje', 'Tag borrado con éxito');
    }
}
