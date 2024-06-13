<x-app-layout>
    <x-principal>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl ">
            <div class="p-6 sm:px-20 border-b border-gray-200 dark:border-gray-600">
                <!-- Estadísticas -->
                <div class="mb-8">
                    <h3 class="text-3xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Estadísticas Generales
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <!-- Usuarios -->
                        <div
                            class="px-4 py-6 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                            <div>
                                <p class="text-lg font-semibold text-white dark:text-gray-200">Usuarios</p>
                                <p class="text-4xl font-bold text-white">{{ $userCount }}</p>
                            </div>
                            <i class="fas fa-users text-6xl text-white"></i>
                        </div>
                        <!-- Publicaciones -->
                        <div
                            class="px-4 py-6 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                            <div>
                                <p class="text-lg font-semibold text-white dark:text-gray-200">Publicaciones</p>
                                <p class="text-4xl font-bold text-white">{{ $postCount }}</p>
                            </div>
                            <i class="fas fa-newspaper text-6xl text-white"></i>
                        </div>
                        <!-- Comentarios -->
                        <div
                            class="px-4 py-6 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                            <div>
                                <p class="text-lg font-semibold text-white dark:text-gray-200">Comentarios</p>
                                <p class="text-4xl font-bold text-white">{{ $commentCount }}</p>
                            </div>
                            <i class="fas fa-comments text-6xl text-white"></i>
                        </div>

                        <!-- Tags -->
                        <div
                            class="px-4 py-6 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                            <div>
                                <p class="text-lg font-semibold text-white dark:text-gray-200">Tags</p>
                                <p class="text-4xl font-bold text-white">{{ $tagsCount }}</p>
                            </div>
                            <i class="fas fa-tag text-6xl text-white"></i>
                        </div>
                        <!-- Likes -->
                        <div
                            class="px-4 py-6 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                            <div>
                                <p class="text-lg font-semibold text-white dark:text-gray-200">Likes</p>
                                <p class="text-4xl font-bold text-white">{{ $totalLikes }}</p>
                            </div>
                            <i class="fas fa-heart text-6xl text-white"></i>
                        </div>
                        <!-- Admin -->
                        <div
                            class="px-4 py-6 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                            <div>
                                <p class="text-lg font-semibold text-white dark:text-gray-200">Admins</p>
                                <p class="text-4xl font-bold text-white">{{ $totalAdmins }}</p>
                            </div>
                            <i class="fa-solid fa-user-tie text-6xl text-white"></i></i>
                        </div>
                    </div>
                </div>

                <!-- Últimas Publicaciones -->
                <div>
                    <h3 class="text-3xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Últimas Publicaciones
                    </h3>
                    <div class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($latestPosts as $post)
                            <a href="{{ route('post.show', $post->id) }}" class="block">
                                <div
                                    class="p-6 flex items-center transition duration-300 transform hover:shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-full mr-6">
                                        <img src="{{ $post->user->profile_photo_url }}"
                                            class="w-full h-full rounded-full" alt="{{ $post->user->name }}">
                                    </div>
                                    <div>
                                        <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $post->titulo }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $post->user->name }} -
                                            {{ $post->created_at->format('d/m/Y H:i:s') }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Lista de Usuarios Recientes -->
                <div class="mt-8">
                    <h3 class="text-3xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Usuarios Recientes</h3>
                    <div class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($recentUsers as $user)
                            <a href="{{ route('perfil.user', $user) }}" class="block">
                                <div
                                    class="p-6 flex items-center transition duration-300 transform hover:shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                        class="w-10 h-10 rounded-full mr-4">
                                    <div>
                                        <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $user->name }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">Registrado el
                                            {{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </x-principal>
</x-app-layout>
