<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ------------------------------- RELACIONES ------------------------------- */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    //relacion N:M con
    public function postsLiked(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
        // devuelve una coleccion de los posts que el usuario le ha dado Like
    }
    //relcion 1:N con Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /* ----------------------------------- -- ----------------------------------- */
    public function isAdmin()
    {
        return $this->isAdmin === 'SI';
    }

    public function getPostsLikesId()
    {
        $ids = [];
        foreach ($this->postsLiked as $post) {
            $ids[] = $post->id;
        }
        return $ids; //un array con los id de los posts que el usuario ha dado Like
    }

    /* --------------------------------- FOLLOW --------------------------------- */

    /*
        ->followers: es la tabla pivot para las relaciones:
        ->user_id: representa el usuario que hace el follow
        ->following_id: representa el usuario que recibe el follow.
    */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id');
    }
}
