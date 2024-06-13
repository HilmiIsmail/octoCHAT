<div>
    <!-- Mostrar la lista de comentarios -->
    @foreach ($miPost->comments as $comment)
        <div class="relative flex items-start mb-4">
            <!-- Foto de perfil del usuario -->
            <a
                href="{{ auth()->id() === $comment->user->id ? route('perfil.show') : route('perfil.user', $comment->user->id) }}">
                <img src="{{ $comment->user->profile_photo_url ?? '' }}" class="w-10 h-10 rounded-full mr-3"
                    alt="Foto de perfil">
            </a>
            <div class="flex flex-col flex-grow">
                <!-- Nombre del usuario -->
                <div class="flex items-center justify-between">
                    <p class="font-semibold mb-1">{{ $comment->user->name }}</p>
                    <!-- Icono para borrar comentario -->
                    @auth
                        @if ($comment->user_id === Auth::user()->id)
                            <div>
                                <button wire:click="borrarComentario({{ $comment->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <button wire:click="editarComentario({{ $comment->id }})">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </div>
                        @endif
                    @endauth
                </div>
                <!-- Contenido del comentario -->
                <p class="text-gray-600">{{ $comment->contenido }}</p>
            </div>
        </div>
    @endforeach

    <!-- Modal para editar comentarios -->
    @if ($mostrarModal)
        <div class="fixed inset-0 z-50 overflow-auto flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-content py-4 text-left px-6">
                    <!-- Título del modal -->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Editar Comentario</p>
                        <button wire:click="$set('mostrarModal', false)" class="modal-close cursor-pointer z-50">
                            <span class="text-3xl">&times;</span>
                        </button>
                    </div>
                    <!-- Contenido del modal -->
                    <textarea wire:model="comentarioEditado" class="w-full border rounded-md p-2" rows="4">{{ $comentarioAEditar->contenido }}</textarea>
                    @error('comentarioEditado')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <!-- Botones de acción -->
                    <div class="mt-4 flex justify-end">
                        <button wire:click="actualizarComentario"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
                        <button wire:click="$set('mostrarModal', false)"
                            class="modal-close bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 ml-2 rounded focus:outline-none focus:shadow-outline">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Input para escribir el comentario -->
    @auth
        <div class="sm:px-4 sm:py-3 p-2.5 border-t border-gray-100 flex items-center gap-1 dark:border-slate-700/40">
            <!-- Foto del usuario -->
            @auth
                <img src="{{ auth()->user()->profile_photo_url }}" alt="" class="w-10 h-10 rounded-full">
            @endauth
            <input wire:model="comentario" type="text" class="w-full border-none rounded-md py-2 px-3 focus:outline-none"
                placeholder="Escribe tu comentario aquí...">
            @auth
                <button wire:click="comentar()"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-md px-4 py-2 ml-2">Enviar</button>
            @else
                <a href="{{ route('login') }}"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none rounded-md px-4 py-2 ml-2">Enviar</a>
            @endauth
        </div>
    @endauth
</div>
