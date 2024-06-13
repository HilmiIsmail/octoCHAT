<x-app-layout>
    <x-principal>
        <!-- Encabezado con el nombre del tag -->
        <h2 class="text-3xl font-semibold mb-6">Últimos posts con el tag "#{{ $tag->nombre }}"</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($posts as $post)
                <div class="bg-white shadow-lg rounded-md overflow-hidden">
                    <!-- Imagen del post -->
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ Storage::url($post->imagen) }}" class="w-full h-56 object-cover" alt="Post Image">
                    </a>
                    <div class="p-6">
                        <!-- Detalles del usuario -->
                        <div class="flex items-center mb-4">
                            <a href="{{ auth()->id() === $post->user->id ? route('perfil.show') : route('perfil.user', $post->user->id) }}"
                                class="flex items-start">
                                <img src="{{ $post->user->profile_photo_url }}" class="w-10 h-10 rounded-full mr-3"
                                    alt="{{ $post->user->name }}">
                                <p class="text-lg text-gray-800 font-semibold">{{ $post->user->name }}</p>
                            </a>
                        </div>
                        <!-- Etiquetas del post -->
                        <div class="flex flex-wrap gap-2">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('tags.show', $tag->id) }}"
                                    class="px-3 py-1 text-[12px] bg-gray-200 max-w-max rounded font-semibold text-[#7281a3]">#{{ $tag->nombre }}</a>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </x-principal>
</x-app-layout>
