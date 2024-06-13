<x-app-layout>
    <x-principal>
        <div class="py-6">
            <div class="max-w-4xl mx-auto bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-10 border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Lista de Usuarios</h2>
                    <!-- Lista de usuarios -->
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($followingUsers as $user)
                            <div class="bg-gray-100 rounded-lg overflow-hidden">
                                <div class="p-4">
                                    <div class="flex items-center mb-4">
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                            class="w-16 h-16 rounded-full mr-4">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                                            <p class="text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <a href="{{ route('chat', $user->id) }}"
                                            class="px-4 py-2 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] ease-in-out p-6 shadow-md flex items-center justify-between transform transition-transform duration-300 hover:-translate-y-1">
                                            Ir a la Conversación
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-principal>
</x-app-layout>
