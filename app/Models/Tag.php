<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    /* ------------------------------- RELACIONES ------------------------------- */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class); //Una etiqueta puede tener muchos post
    }

    /* -------------------------- ACCESORS Y  MUTATORS -------------------------- */
    public function nombre(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }
}
