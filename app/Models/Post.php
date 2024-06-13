<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'contenido',
        'imagen',
        'estado',
        'user_id',
    ];

    /* ------------------------------- RELACIONES ------------------------------- */
    //relacion 1:N con User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relcion N:M con Tag
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    //relcion 1:N con Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* -------------------------- ACCESORS Y  MUTATORS -------------------------- */
    public function contenido(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value),
        );
    }

    /* ---------------------------------- LIKES --------------------------------- */
    public function likedByUsers(): BelongsToMany
    {
        // devuelve una coleccion de los usuarios  que le han dado like a este post.
        return $this->belongsToMany(User::class);
    }

    /* devolver los ids de tags de cada post para usarlos en UpdatePost */
    public function getTagsId(): array
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = $tag->id;
        }
        return $tags;
    }
}
