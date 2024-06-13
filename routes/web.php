<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TagController;
use App\Livewire\Home;
use App\Livewire\LikePost;
use App\Livewire\ManageTags;
use App\Livewire\Notifications;
use App\Livewire\Profile;
use App\Livewire\ShowPost;
use App\Mail\Support;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* ---------------------------------- HOME ---------------------------------- */

Route::get('/', Home::class)->name('home');

/* -------------------------------- DASHBOARD ------------------------------- */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // Verificar si el usuario actual es administrador
        if (!Auth::user()->isAdmin()) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        $userCount = User::count();
        $postCount = Post::count();
        $commentCount = Comment::count();
        $tagsCount = Tag::count();
        $totalLikes = Post::withCount('likedByUsers')->get()->pluck('liked_by_users_count')->sum();
        $totalAdmins = User::where('isAdmin', "SI")->count();
        $latestPosts = Post::latest()->paginate(5);
        $recentUsers = User::latest()->take(5)->get();
        return view('dashboard', compact('userCount', 'postCount', 'commentCount', 'latestPosts', 'totalAdmins', 'recentUsers', 'tagsCount', 'totalLikes'));
    })->name('dashboard');


    /* --------------------------- PERFIL DE USUARIO --------------------------- */
    //perfil del resto de usuarios
    Route::get('/user/{user}/profile', [ProfileController::class, 'showUser'])->name('perfil.user');

    //perfil de usuario authenticado
    Route::get('perfil', [ProfileController::class, 'show'])->name('perfil.show');
});


//los likes que ha dado el usuario
Route::get('/mis-likes', [ProfileController::class, 'likes'])->name('mis-likes');

/* ---------------------------------- POST ---------------------------------- */
//show post info
Route::get('/post/{post}', ShowPost::class)->name('post.show');

/* ---------------------------------- POSTs TAG ---------------------------------- */
//mostrar los posts con dicho tag
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');

/* ---------------------------------- FOLLoW --------------------------------- */
Route::middleware(['auth'])->group(function () {
    Route::post('follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::post('unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
});
/* ---------------------------------- TAGS ---------------------------------- */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/manage-tags', ManageTags::class)->name('manage-tags');
});

/* ---------------------------------- CHAT ---------------------------------- */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('chat', [ChatController::class, 'index'])->name('chat-list');
    Route::get('chat/{id}', [ChatController::class, 'chat'])->name('chat');
});

/* --------------------------------- SUPPORT -------------------------------- */
Route::get('soporte', [SupportController::class, 'pintarFormulario'])->name('soporte.index');
Route::post('soporte', [SupportController::class, 'procesarFormulario'])->name('soporte.procesar');

/* ------------------------------ PROXIMAMENTE ------------------------------ */
Route::view('/proximamente', 'aplicacion\proximamente')->name('proximamente');
