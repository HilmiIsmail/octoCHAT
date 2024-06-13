<x-app-layout>
    <x-principal>
        {{-- CONTENIDO --}}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 border-b border-gray-200">
                        <h2 class="text-2xl font-semibold mb-4">Mis Likes</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @if ($postsLikes->count() > 0)
                                @foreach ($postsLikes as $post)
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}"
                                        class="relative group overflow-hidden rounded-lg shadow-lg">
                                        <div
                                            class="relative transition-transform duration-300 ease-in-out transform group-hover:translate-y-[-5px] rounded-lg overflow-hidden">
                                            <img src="{{ Storage::url($post->imagen) }}" alt="Imagen de post"
                                                class="w-full h-60 object-cover rounded-lg">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-60 flex justify-center items-center opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100 text-white">
                                                <i class="fa-solid fa-heart text-red-500 mr-2"></i>
                                                {{ $post->likedByUsers()->count() }}
                                            </div>
                                            <div class="absolute bottom-4 left-4 flex items-center gap-4 text-white">
                                                <img src="{{ $post->user->profile_photo_url }}" alt="Foto de perfil"
                                                    class="w-10 h-10 object-cover rounded-full">
                                                <span class="font-bold">{{ $post->user->name }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="text-gray-500 text-center col-span-full">No has dado like a ningún post.
                                </div>
                            @endif
                        </div>
                        <div class="mt-8">
                            {{ $postsLikes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-principal>
</x-app-layout>
