<x-principal>
    {{-- CONTENIDO --}}
    <div class="flex justify-center space-x-8">
        <div class="flex justify-center flex-col items-center">
            @auth
                <div class="mb-4">
                    <a href="#" id="exploreLink" class="text-gray-500 font-bold hover:underline mr-6">Explorar</a>
                    <a href="#" id="followingLink" class="text-gray-500 font-bold hover:underline">Siguiendo</a>
                </div>

            @endauth

            {{-- Parte central para los posts --}}
            <div id="explorePosts" class="w-fit flex-grow bg-white rounded-lg shadow p-6">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Explora los Posts</h2>
                @foreach ($posts as $post)
                    <!-- Contenedor del post -->
                    <article
                        class="bg-white rounded-xl shadow-md text-sm font-medium border border-gray-200 mb-10 overflow-hidden">
                        <!-- Encabezado del post -->
                        <header class="flex gap-3 sm:p-4 p-2.5 text-sm font-medium">
                            <div class="flex items-center">
                                <!-- Foto de perfil del usuario -->
                                <a
                                    href="{{ auth()->id() === $post->user->id ? route('perfil.show') : route('perfil.user', $post->user->id) }}">
                                    <img src="{{ $post->user->profile_photo_url }}" class="w-10 h-10 rounded-full mr-3"
                                        alt="{{ $post->user->name }}">
                                </a>
                                <!-- Nombre del usuario y fecha del post -->
                                <div class="flex-1">
                                    <!-- Nombre del usuario y fecha del post -->
                                    <a
                                        href="{{ auth()->id() === $post->user->id ? route('perfil.show') : route('perfil.user', $post->user->id) }}">
                                        <h4 class="text-black dark:text-white">{{ $post->user->name }}</h4>
                                    </a>
                                    <div class="text-xs text-gray-500 dark:text-white/80">
                                        {{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <!-- Botón de opciones -->
                            @if (auth()->id() === $post->user->id)
                                <div class="flex items-center space-x-2">
                                    <button wire:click="pedirConfirmacion({{ $post->id }})"
                                        class="text-gray-500 hover:text-red-500 focus:outline-none">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button wire:click="edit({{ $post->id }})"
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            @endif
                        </header>

                        <!-- Contenido del post -->
                        <div class="p-4">
                            <!-- Texto del post -->
                            <p class="text-gray-800 mb-3">{{ $post->contenido }}</p>
                            <!-- Imagen del post -->
                            <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                <div class=" w-3/4 h-full mx-auto">
                                    <img src="{{ Storage::url($post->imagen) }}" alt="{{ $post->contenido }}"
                                        class="sm:rounded-lg w-full h-full object-cover p-3 mx-auto">
                                </div>
                            </a>
                            <!-- Etiquetas del post -->
                            <div class="flex flex-wrap gap-2">
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('tags.show', $tag->id) }}"
                                        class="px-3 py-1 text-[12px] bg-gray-200 max-w-max rounded font-semibold text-[#7281a3]">#{{ $tag->nombre }}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Botones de interacción -->
                        <footer class="flex items-center justify-between px-4 py-2 bg-gray-100">
                            <div class="flex items-center space-x-4">
                                <!-- Botón de like -->
                                @auth
                                    <div class="flex items-center">
                                        <button wire:click="like({{ $post->id }})">
                                            <i @class([
                                                'fa-solid fa-heart text-xl',
                                                'text-red-600' => in_array($post->id, $postsLikes),
                                            ])></i>
                                            <span class="ml-1">{{ $post->likedByUsers()->count() }}</span>
                                        </button>
                                    </div>
                                @else
                                    <!-- Redirigir a la página de inicio de sesión si el usuario no está autenticado -->
                                    <a href="{{ route('login') }}" class="flex items-center">
                                        <i class="fa-solid fa-heart text-gray-600"></i>
                                        <span class="ml-1">{{ $post->likedByUsers()->count() }}</span>
                                    </a>
                                @endauth
                                <!-- Botón de comentarios -->
                                <button class="flex items-center focus:outline-none">
                                    <i class="fa-solid fa-comment text-xl text-gray-600 mr-1"></i>
                                    {{ $post->comments->count() }}
                                </button>
                            </div>
                        </footer>
                        <!-- Fotos de perfil de usuarios que han dado like -->
                        <div class="flex items-center p-6 bg-white">
                            <div class="flex -space-x-3">
                                @foreach ($this->getUsuariosLikes($post->id) as $user)
                                    <img class="w-8 h-8 border-2 border-white rounded-full"
                                        src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                @endforeach
                                @if ($post->likedByUsers()->count() > 2)
                                    <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600"
                                        href="#">+{{ $post->likedByUsers()->count() - 2 }}</a>
                                @endif
                            </div>
                            <p class="ml-4 text-sm text-gray-600">{{ $this->getMensajeLikes($post->id) }}</p>
                        </div>
                        <!-- Comentarios -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">Comentarios</h3>
                            <!-- Mostrar solo dos comentarios -->
                            @foreach ($post->comments->reverse()->take(2) as $comment)
                                @if ($comment->user)
                                    <div class="flex items-start mb-4">
                                        <!-- Foto de perfil del usuario -->
                                        <a
                                            href="{{ auth()->id() === $comment->user->id ? route('perfil.show') : route('perfil.user', $comment->user->id) }}">
                                            <img src="{{ $comment->user->profile_photo_url ?? '' }}"
                                                class="w-10 h-10 rounded-full mr-3" alt="Foto de perfil">
                                        </a>
                                        <!-- Nombre y contenido del comentario -->
                                        <div class="flex flex-col flex-grow">
                                            <div class="flex items-center justify-between">
                                                <p class="font-semibold mb-1">{{ $comment->user->name }}</p>
                                                <!-- Icono para borrar comentario -->
                                                @if ($usuario && $comment->user_id === $usuario->id)
                                                    <div cla ss="flex space-x-2">
                                                        <button wire:click="borrarComentario({{ $comment->id }})"
                                                            class="text-gray-500 hover:text-red-500 focus:outline-none">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button wire:click="editarComentario({{ $comment->id }})"
                                                            class="text-gray-500 hover:text-blue-500 focus:outline-none">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="text-gray-600">{{ $comment->contenido }}</p>
                                        </div>
                                    </div>
                                    <!-- Modal para editar comentarios -->
                                    @if ($mostrarModal && $comentarioId === $comment->id)
                                        <div
                                            class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="modal-content bg-white p-4 rounded shadow-lg w-1/2">
                                                <textarea wire:model="comentarioEditado" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none"
                                                    rows="4">{{ $comentarioAEditar->contenido }}</textarea>
                                                @error('comentarioEditado')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                                <div class="mt-4 flex justify-end">
                                                    <button wire:click="actualizarComentario"
                                                        class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-lg px-4 py-2">Guardar</button>
                                                    <button wire:click="$set('mostrarModal', false)"
                                                        class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            <!-- Enlace "Ver todos comentarios" -->
                            @if ($post->comments->count() > 2)
                                <div class="text-gray-500 cursor-pointer mt-5">
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}">Ver todos comentarios<i
                                            class="fa-solid fa-angle-down ml-2"></i></a>
                                </div>
                            @endif
                            <!-- Formulario para agregar comentario -->
                            <div
                                class="sm:px-4 sm:py-3 p-2.5 border-t border-gray-100 flex items-center gap-1 dark:border-slate-700/40">
                                <!-- Foto del usuario -->
                                @auth
                                    <img src="{{ auth()->user()->profile_photo_url }}" alt=""
                                        class="w-10 h-10 rounded-full">
                                @endauth
                                <input wire:model="comentario" type="text"
                                    class="w-full border-none rounded-md py-2 px-3 focus:outline-none"
                                    placeholder="Escribe tu comentario aquí...">
                                @auth
                                    <button wire:click="comentar({{ $post->id }})"
                                        class="text-white bg-[#8379BE] px-4 py-2 ml-2 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                        </svg>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-md px-4 py-2 ml-2">Enviar</a>
                                @endauth
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            @if (count($postsSiguiendo))
                <div id="followingPosts" style="display: none;"
                    class="w-fit flex-grow bg-white rounded-lg shadow p-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Explora los Posts</h2>
                    @foreach ($postsSiguiendo as $post)
                        <!-- Contenedor del post -->
                        <article
                            class="bg-white rounded-xl shadow-md text-sm font-medium border border-gray-200 mb-10 overflow-hidden">
                            <!-- Encabezado del post -->
                            <header class="flex gap-3 sm:p-4 p-2.5 text-sm font-medium">
                                <div class="flex items-center">
                                    <!-- Foto de perfil del usuario -->
                                    <a
                                        href="{{ auth()->id() === $post->user->id ? route('perfil.show') : route('perfil.user', $post->user->id) }}">
                                        <img src="{{ $post->user->profile_photo_url }}"
                                            class="w-10 h-10 rounded-full mr-3" alt="{{ $post->user->name }}">
                                    </a>
                                    <!-- Nombre del usuario y fecha del post -->
                                    <div class="flex-1">
                                        <!-- Nombre del usuario y fecha del post -->
                                        <a
                                            href="{{ auth()->id() === $post->user->id ? route('perfil.show') : route('perfil.user', $post->user->id) }}">
                                            <h4 class="text-black dark:text-white">{{ $post->user->name }}</h4>
                                        </a>
                                        <div class="text-xs text-gray-500 dark:text-white/80">
                                            {{ $post->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <!-- Botón de opciones -->
                                @if (auth()->id() === $post->user->id)
                                    <div class="flex items-center space-x-2">
                                        <button wire:click="pedirConfirmacion({{ $post->id }})"
                                            class="text-gray-500 hover:text-red-500 focus:outline-none">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button wire:click="edit({{ $post->id }})"
                                            class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                @endif
                            </header>

                            <!-- Contenido del post -->
                            <div class="p-4">
                                <!-- Texto del post -->
                                <p class="text-gray-800 mb-3">{{ $post->contenido }}</p>
                                <!-- Imagen del post -->
                                <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                    <div class=" w-3/4 h-full mx-auto">
                                        <img src="{{ Storage::url($post->imagen) }}" alt="{{ $post->contenido }}"
                                            class="sm:rounded-lg w-full h-full object-cover p-3 mx-auto">
                                    </div>
                                </a>
                                <!-- Etiquetas del post -->
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('tags.show', $tag->id) }}"
                                            class="px-3 py-1 text-[12px] bg-gray-200 max-w-max rounded font-semibold text-[#7281a3]">#{{ $tag->nombre }}</a>
                                    @endforeach
                                </div>
                            </div>


                            <!-- Botones de interacción -->
                            <footer class="flex items-center justify-between px-4 py-2 bg-gray-100">
                                <div class="flex items-center space-x-4">
                                    <!-- Botón de like -->
                                    @auth
                                        <div class="flex items-center">
                                            <button wire:click="like({{ $post->id }})">
                                                <i @class([
                                                    'fa-solid fa-heart text-xl',
                                                    'text-red-600' => in_array($post->id, $postsLikes),
                                                ])></i>
                                                <span class="ml-1">{{ $post->likedByUsers()->count() }}</span>
                                            </button>
                                        </div>
                                    @else
                                        <!-- Redirigir a la página de inicio de sesión si el usuario no está autenticado -->
                                        <a href="{{ route('login') }}" class="flex items-center">
                                            <i class="fa-solid fa-heart text-gray-600"></i>
                                            <span class="ml-1">{{ $post->likedByUsers()->count() }}</span>
                                        </a>
                                    @endauth
                                    <!-- Botón de comentarios -->
                                    <button class="flex items-center focus:outline-none">
                                        <i class="fa-solid fa-comment text-xl text-gray-600 mr-1"></i>
                                        {{ $post->comments->count() }}
                                    </button>
                                </div>
                            </footer>
                            <!-- Fotos de perfil de usuarios que han dado like -->
                            <div class="flex items-center p-6 bg-white">
                                <div class="flex -space-x-3">
                                    @foreach ($this->getUsuariosLikes($post->id) as $user)
                                        <img class="w-8 h-8 border-2 border-white rounded-full"
                                            src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                    @endforeach
                                    @if ($post->likedByUsers()->count() > 2)
                                        <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600"
                                            href="#">+{{ $post->likedByUsers()->count() - 2 }}</a>
                                    @endif
                                </div>
                                <p class="ml-4 text-sm text-gray-600">{{ $this->getMensajeLikes($post->id) }}</p>
                            </div>
                            <!-- Comentarios -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">Comentarios</h3>
                                <!-- Mostrar solo dos comentarios -->
                                @foreach ($post->comments->reverse()->take(2) as $comment)
                                    @if ($comment->user)
                                        <div class="flex items-start mb-4">
                                            <!-- Foto de perfil del usuario -->
                                            <a
                                                href="{{ auth()->id() === $comment->user->id ? route('perfil.show') : route('perfil.user', $comment->user->id) }}">
                                                <img src="{{ $comment->user->profile_photo_url ?? '' }}"
                                                    class="w-10 h-10 rounded-full mr-3" alt="Foto de perfil">
                                            </a>
                                            <!-- Nombre y contenido del comentario -->
                                            <div class="flex flex-col flex-grow">
                                                <div class="flex items-center justify-between">
                                                    <p class="font-semibold mb-1">{{ $comment->user->name }}</p>
                                                    <!-- Icono para borrar comentario -->
                                                    @if ($usuario && $comment->user_id === $usuario->id)
                                                        <div cla ss="flex space-x-2">
                                                            <button wire:click="borrarComentario({{ $comment->id }})"
                                                                class="text-gray-500 hover:text-red-500 focus:outline-none">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <button wire:click="editarComentario({{ $comment->id }})"
                                                                class="text-gray-500 hover:text-blue-500 focus:outline-none">
                                                                <i class="fas fa-pen"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="text-gray-600">{{ $comment->contenido }}</p>
                                            </div>
                                        </div>
                                        <!-- Modal para editar comentarios -->
                                        @if ($mostrarModal && $comentarioId === $comment->id)
                                            <div
                                                class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                                <div class="modal-content bg-white p-4 rounded shadow-lg w-1/2">
                                                    <textarea wire:model="comentarioEditado" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none"
                                                        rows="4">{{ $comentarioAEditar->contenido }}</textarea>
                                                    @error('comentarioEditado')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                    <div class="mt-4 flex justify-end">
                                                        <button wire:click="actualizarComentario"
                                                            class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-lg px-4 py-2">Guardar</button>
                                                        <button wire:click="$set('mostrarModal', false)"
                                                            class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                                <!-- Enlace "Ver todos comentarios" -->
                                @if ($post->comments->count() > 2)
                                    <div class="text-gray-500 cursor-pointer mt-5">
                                        <a href="{{ route('post.show', ['post' => $post->id]) }}">Ver todos
                                            comentarios<i class="fa-solid fa-angle-down ml-2"></i></a>
                                    </div>
                                @endif
                                <!-- Formulario para agregar comentario -->
                                <div
                                    class="sm:px-4 sm:py-3 p-2.5 border-t border-gray-100 flex items-center gap-1 dark:border-slate-700/40">
                                    <!-- Foto del usuario -->
                                    @auth
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt=""
                                            class="w-10 h-10 rounded-full">
                                    @endauth
                                    <input wire:model="comentario" type="text"
                                        class="w-full border-none rounded-md py-2 px-3 focus:outline-none"
                                        placeholder="Escribe tu comentario aquí...">
                                    @auth
                                        <button wire:click="comentar({{ $post->id }})"
                                            class="text-white bg-[#8379BE] px-4 py-2 ml-2 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                            </svg>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-md px-4 py-2 ml-2">Enviar</a>
                                    @endauth
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="w-fit flex-grow bg-white rounded-lg shadow p-6">
                    <img src="{{ Storage::url('noPosts.png') }}" alt="{{ $post->contenido }}"
                        class="sm:rounded-lg  object-cover p-3 mx-auto">

                </div>
            @endif


        </div>
        <!-- MODAL para actualizar post ------------------------------------------------------------------->
        @isset($form->post)
            <x-dialog-modal wire:model="openModalUpdate" class="bg-white shadow-xl">
                <x-slot name="title" class="text-lg font-bold text-gray-900">
                    ACTUALIZAR POST
                </x-slot>
                <x-slot name="content">
                    {{-- CONTENIDO --}}
                    <div class="mb-4">
                        <label for="contenido" class="block font-bold text-gray-700">Contenido del Artículo</label>
                        <textarea id="contenido" rows="4" placeholder="Contenido..." wire:model="form.contenido"
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        <x-input-error for="form.contenido" />
                    </div>

                    {{-- ESTADO --}}
                    <div class="mb-4 flex items-center">
                        <input id="estado" type="checkbox" value="PUBLICADO" wire:model="form.estado"
                            @checked($form->estado == 'PUBLICADO')
                            class="appearance-none border-2 border-gray-500 rounded-md w-6 h-6 transition-colors duration-300 cursor-pointer checked:bg-[#756AB6]">
                        <label for="estado" class="ml-2 font-bold text-gray-700">Publicar artículo</label>
                    </div>
                    <x-input-error for="form.estado" />

                    {{-- TAGS --}}
                    <div class="mb-4">
                        <label for="tags" class="block font-bold text-gray-700">Etiquetas</label>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach ($misTags as $tag)
                                <div class="flex items-center">
                                    <input id="{{ $tag->nombre }}" type="checkbox" value="{{ $tag->id }}"
                                        wire:model="form.tags" class="focus:ring-blue-500 border-gray-300 rounded mr-2">
                                    <label for="{{ $tag->nombre }}" class="text-gray-700">
                                        <p class="px-1 py-1 rounded-lg" style="background-color:{{ $tag->color }}">
                                            {{ $tag->nombre }}
                                        </p>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error for="form.tags" />
                    </div>

                    {{-- IMAGEN --}}
                    <div class="mb-4 border-dashed border-2 border-gray-300 rounded-md">
                        <label for="imagenU" class="block font-bold text-gray-700">Imagen del artículo</label>
                        <div class="relative w-full h-96">
                            <input type="file" accept="image/*" id="imagenU" hidden wire:model="form.imagen" />
                            <div class="bg-gray-200 h-full w-full rounded-md flex justify-center items-center">
                                @if ($form->imagen)
                                    <img src="{{ $form->imagen->temporaryUrl() }}" alt="Imagen del artículo"
                                        class="h-full w-full object-cover">
                                @else
                                    <img src="{{ Storage::url($form->post->imagen) }}" alt="Imagen del artículo"
                                        class="h-full w-full object-cover">
                                @endif
                            </div>
                            <label for="imagenU"
                                class="absolute bottom-2 right-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                <i class="fa-solid fa-cloud-arrow-up mr-1"></i>Upload
                            </label>
                        </div>
                        <x-input-error for="form.imagen" />
                    </div>
                </x-slot>
                <x-slot name="footer" class="flex justify-end">
                    <button wire:click="update"
                        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        <i class="fas fa-edit mr-1"></i> EDITAR
                    </button>
                    <button wire:click="cancelarUpdate"
                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        <i class="fas fa-times mr-1"></i> CANCELAR
                    </button>
                </x-slot>
            </x-dialog-modal>

        @endisset
        <!-- FIN MODAL ---------------------------------------------------------------------------------------->
        <!-- Sección derecha -->
        <div class="hidden lg:block lg:w-1/5 justify-end min-h-screen sticky top-0 ">
            @auth
                {{-- Sugerencias de perfiles --}}
                <div class="hidden lg:block space-y-4">
                    <div class="py-5">
                        <div class="flex items-baseline justify-between text-black">
                            <h3 class="font-bold text-base">Sugerencias</h3>

                        </div>

                        <div class="mt-4 space-y-4">
                            @foreach ($sugerencias as $perfil)
                                <div
                                    class="mx-auto py-2 transition transform hover:shadow-lg hover:-translate-y-1 text-center">
                                    <a href="{{ route('perfil.user', $perfil->id) }}" class="block mb-4">
                                        <img src="{{ $perfil->profile_photo_url }}" alt="perfil"
                                            class="rounded-full h-16 w-16 border-2 border-gray-200 mx-auto" />
                                    </a>
                                    <div class="flex-1">
                                        <a href="{{ route('perfil.user', $perfil->id) }}">
                                            <h4 class="text-sm font-medium text-gray-800 hover:text-blue-500">
                                                {{ $perfil->name }}
                                            </h4>
                                        </a>
                                        <div class="text-xs text-gray-500">
                                            {{ $perfil->followers()->count() }} seguidores
                                        </div>
                                    </div>
                                    <a href="{{ route('perfil.user', $perfil->id) }}"
                                        class="block mt-4 text-white bg-[#8379BE] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium  text-sm py-2.5 text-center mx-auto transition duration-200 ease-in-out">
                                        Perfil
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                {{-- Tags --}}
                <div class="py-3">
                    <h3 class="font-bold text-base">Tags Populares</h3>
                    <div class="mt-4 space-y-2">
                        @foreach ($tags as $tag)
                            <a href="{{ route('tags.show', $tag->id) }}"
                                class="block text-sm text-gray-700 hover:text-[#8379BE]">
                                #{{ $tag->nombre }} ({{ $tag->posts->count() }})
                            </a>
                        @endforeach
                    </div>
                </div>
            @endauth

            {{-- Google Play y App Store Aplicación --}}
            <div class="flex flex-col py-3 space-y-4">
                <h3 class="font-bold text-base">Obtenga nuestra aplicación en: </h3>
                <button type="button" onclick="window.location='{{ route('proximamente') }}'"
                    class="flex items-center justify-center w-48 mt-3 text-black bg-transparent border border-black h-14 rounded-xl">
                    <div class="mr-3">
                        <svg viewBox="0 0 384 512" width="30">
                            <path fill="currentColor"
                                d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs">
                            Download on the
                        </div>
                        <div class="-mt-1 font-sans text-2xl font-semibold">
                            App Store
                        </div>
                    </div>
                </button>
                <button onclick="window.location='{{ route('proximamente') }}'" type="button"
                    class="flex items-center justify-center w-48 mt-3 text-white bg-black rounded-lg h-14">
                    <div class="mr-3">
                        <svg viewBox="30 336.7 120.9 129.2" width="30">
                            <path fill="#FFD400"
                                d="M119.2,421.2c15.3-8.4,27-14.8,28-15.3c3.2-1.7,6.5-6.2,0-9.7  c-2.1-1.1-13.4-7.3-28-15.3l-20.1,20.2L119.2,421.2z">
                            </path>
                            <path fill="#FF3333"
                                d="M99.1,401.1l-64.2,64.7c1.5,0.2,3.2-0.2,5.2-1.3  c4.2-2.3,48.8-26.7,79.1-43.3L99.1,401.1L99.1,401.1z">
                            </path>
                            <path fill="#48FF48"
                                d="M99.1,401.1l20.1-20.2c0,0-74.6-40.7-79.1-43.1  c-1.7-1-3.6-1.3-5.3-1L99.1,401.1z">
                            </path>
                            <path fill="#3BCCFF"
                                d="M99.1,401.1l-64.3-64.3c-2.6,0.6-4.8,2.9-4.8,7.6  c0,7.5,0,107.5,0,113.8c0,4.3,1.7,7.4,4.9,7.7L99.1,401.1z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs">
                            GET IT ON
                        </div>
                        <div class="-mt-1 font-sans text-xl font-semibold">
                            Google Play
                        </div>
                </button>
            </div>
        </div>
    </div>

    </div>
</x-principal>
<script>
    let exploreLink = document.getElementById('exploreLink');
    let followingLink = document.getElementById('followingLink');
    let explorePosts = document.getElementById('explorePosts');
    let followingPosts = document.getElementById('followingPosts');

    exploreLink.addEventListener('click', () => {
        exploreLink.classList.add('font-bold');
        followingLink.classList.remove('font-bold');
        explorePosts.style.display = 'block';
        followingPosts.style.display = 'none';
    });

    followingLink.addEventListener('click', () => {
        exploreLink.classList.remove('font-bold');
        followingLink.classList.add('font-bold');
        explorePosts.style.display = 'none';
        followingPosts.style.display = 'block';
    });
</script>
