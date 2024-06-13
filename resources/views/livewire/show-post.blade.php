<x-principal>
    <div class="flex justify-center ">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full">
            <div class="p-6 sm:px-20 border-b border-gray-200">

                <!-- Información del propietario del post -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-start">
                        <a href="{{ auth()->id() === $post->user->id ? route('perfil.show') : route('perfil.user', $post->user->id) }}"
                            class="flex items-start mb-4">
                            <img src="{{ $post->user->profile_photo_url }}" class="w-12 h-12 rounded-full mr-4"
                                alt="{{ $post->user->name }}">
                        </a>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
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
                    @if (auth()->id() === $post->user->id)
                        <div>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                <span class="font-bold">ESTADO: </span>
                                <button wire:click="actualizarDisponibilidad({{ $post->id }})"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:border-gray-300 focus:ring focus:ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150 {{ $post->estado == 'ARCHIVADO' ? 'text-red-500 line-through' : 'text-green-500' }}">
                                    <span class="mr-1">{{ $post->estado }}</span>
                                    @if ($post->estado == 'ARCHIVADO')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    @endif
                                </button>
                            </p>
                        </div>
                    @endif

                </div>

                <!-- Contenido del Post -->
                <div class="mb-6">
                    <p class="text-lg text-gray-800">{{ $post->contenido }}</p>
                </div>

                <!-- Imagen del Post -->
                <div class="mb-6 relative w-full flex justify-center">
                    @if ($post->estado == 'ARCHIVADO')
                        <div
                            class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50">
                            <p class="text-white font-bold text-xl">ARCHIVADO</p>
                        </div>
                    @endif
                    <img src="{{ Storage::url($post->imagen) }}" class="max-w-full h-auto" alt="Imagen de post">
                </div>

                <!-- Etiquetas del post -->
                <div class="flex flex-wrap gap-2">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag->id) }}"
                            class="px-3 py-1 text-[12px] bg-[#ddd] max-w-max rounded font-semibold text-[#7281a3]">#{{ $tag->nombre }}</a>
                    @endforeach
                </div>

                <!-- Botones de interacción -->
                <footer class="flex items-center justify-between px-4 py-2 bg-gray-100">
                    <div class="flex items-center space-x-4">
                        <!-- Botón de like -->
                        @auth
                            <div class="flex items-center">
                                @livewire('like-post', ['post' => $post])
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

                <!-- Comentarios -->
                <div class="px-6 py-4 rounded-lg">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Comentarios</h3>
                    </div>
                    <!-- cargar el componente Livewire para comentarios y el formulario de escribir un comentario nuevo -->
                    @livewire('comentar', ['postId' => $post->id])
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL para actualizar post ------------------------------------------------------------------->
    @isset($form->post)
        <x-dialog-modal wire:model="modalUpdate" class="bg-white shadow-xl">
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
</x-principal>
