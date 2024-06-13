<x-app-layout>
    <x-principal>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="pb-4 sm:px-20 border-b border-gray-200">
                    <!-- Contenido del perfil -->
                    <div class="flex flex-col items-center justify-center text-center py-8">
                        <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil" class="w-32 h-32 rounded-full mb-4">
                        <div class="text-2xl font-semibold mb-2">{{ $user->name }}</div>
                        <div class="text-gray-600 mb-4">{{ $user->email }}</div>
                        <div class="text-gray-600 mb-4">
                            <span>{{ $posts->count() }} publicaciones</span> |
                            <span>{{ $followersCount }} seguidores</span> |
                            <span>{{ $followingCount }} siguiendo</span>
                        </div>
                        <!-- Botones de acción -->
                        <div class="flex gap-4 mb-8">
                            @if ($user->id !== auth()->id())
                                <a href="{{ route('chat', $user->id) }}"
                                    class="px-4 py-2 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] transition duration-300 ease-in-out">Mensaje</a>
                            @else
                                <a href="{{ route('chat-list') }}"><button
                                        class="px-4 py-2 bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] text-white transition duration-300 ease-in-out">Ir
                                        a Mensajes</button></a>
                            @endif


                            @if (auth()->id() !== $user->id)
                                @if (auth()->user()->following->contains($user))
                                    <form action="{{ route('unfollow', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 text-white bg-[#EB497B] hover:bg-[#d63e6d] focus:ring-4 focus:outline-none focus:ring-[#d63e6d] dark:focus:ring-[#b6325a] transition duration-300 ease-in-out">Dejar
                                            de seguir</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#63BCAA] hover:bg-[#57a495] focus:ring-4 focus:outline-none focus:ring-[#57a495] dark:focus:ring-[#4b8c7e] text-white transition duration-300 ease-in-out">Seguir</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('profile.show') }}"><button
                                        class="px-4 py-2 bg-[#E8E2E2] hover:bg-[#c7c1c1] focus:ring-4 focus:outline-none focus:ring-[#3da2d4] dark:focus:ring-[#358bb8] text-black transition duration-300 ease-in-out">Editar
                                        perfil</button></a>
                            @endif
                        </div>


                    </div>

                    <!-- Lista de Publicaciones del Usuario -->
                    <div class="text-2xl font-semibold mb-4 text-center">Publicaciones del Usuario</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <a href="{{ route('post.show', ['post' => $post->id]) }}"
                                    class="overflow-hidden shadow-lg">
                                    <img src="{{ Storage::url($post->imagen) }}" alt="{{ $post->contenido }}"
                                        class="w-full h-64 object-cover">
                                </a>
                            @endforeach
                        @else
                            <div class="text-gray-500 text-center">Este usuario no tiene publicaciones.</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </x-principal>
</x-app-layout>
