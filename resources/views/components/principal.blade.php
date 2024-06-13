<div class="py-5 bg-white">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 flex flex-col sm:flex-row gap-8">
        @auth
            {{-- Menu de la izquierda (para pantallas grandes) --}}
            <nav class="hidden sm:flex flex-col items-center w-1/6">
                <div class="shadow px-4 py-6 fixed">
                    <!-- Imagen de perfil del usuario -->
                    <a href="{{ route('perfil.show') }}">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="Perfil"
                            class="w-20 h-20 mx-auto rounded-full mb-4">
                    </a>
                    <!-- Elementos del menú -->
                    <a href="{{ route('home') }}"
                        class="menu-item flex items-center px-6 py-3 text-gray-700 gap-4 hover:transform hover:scale-105 transition duration-200 ease-in-out {{ Request::routeIs('home') ? 'font-bold' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>

                    <a href="{{ route('perfil.show') }}"
                        class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4 {{ Request::routeIs('perfil.*') ? 'font-bold' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        Perfil
                    </a>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                            class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4 {{ Request::routeIs('dashboard') ? 'font-bold' : '' }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('manage-tags') }}"
                            class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4 {{ Request::routeIs('manage-tags') ? 'font-bold' : '' }}">
                            <i class="fa-solid fa-hashtag"></i>
                            Tags
                        </a>
                    @endif
                    <a href="{{ route('mis-likes') }}"
                        class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4 {{ Request::routeIs('mis-likes') ? 'font-bold' : '' }}">
                        <i class="fa-solid fa-heart"></i>
                        Mis Likes
                    </a>

                    <a href="{{ route('chat-list') }}"
                        class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4 {{ Request::routeIs('chat-list') ? 'font-bold' : '' }}">
                        <i class="fa-solid fa-comments"></i>
                        Chat
                    </a>
                    <a href="{{ route('soporte.index') }}"
                        class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4 {{ Request::routeIs('soporte.index') ? 'font-bold' : '' }}">
                        <i class="fa-solid fa-headset"></i>
                        Support
                    </a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data
                        class="menu-item flex items-center px-6 py-3 text-gray-700 hover:transform hover:scale-105 transition duration-200 ease-in-out gap-4">
                        @csrf
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </nav>

            {{-- Contenido principal --}}
            <div class="w-full">
                {{ $slot }}
            </div>
        @else
            <div class="w-3/4 mx-auto ps-10">
                {{ $slot }}
            </div>
        @endauth
    </div>

    {{-- Barra de navegación inferior (para dispositivos pequeños) --}}
    @auth
        <nav class="sm:hidden fixed bottom-0 left-0 right-0 bg-white shadow-t flex justify-around items-center py-2">
            <a href="{{ route('home') }}"
                class="menu-item p-3 {{ Request::routeIs('home') ? 'text-[#8379BE]' : 'text-gray-700' }}">
                <i class="fa-solid fa-house text-xl"></i>
            </a>
            <a href="{{ route('perfil.show') }}"
                class="menu-item p-3 {{ Request::routeIs('perfil.*') ? 'text-[#8379BE]' : 'text-gray-700' }}">
                <i class="fa-solid fa-user text-xl"></i>
            </a>
            @if (Auth::user()->isAdmin())
                <a href="{{ route('dashboard') }}"
                    class="menu-item p-3 {{ Request::routeIs('dashboard') ? 'text-[#8379BE]' : 'text-gray-700' }}">
                    <i class="fa-solid fa-chart-pie text-xl"></i>
                </a>
                <a href="{{ route('manage-tags') }}"
                    class="menu-item p-3 {{ Request::routeIs('manage-tags') ? 'text-[#8379BE]' : 'text-gray-700' }}">
                    <i class="fa-solid fa-hashtag text-xl"></i>
                </a>
            @endif
            <a href="{{ route('mis-likes') }}"
                class="menu-item p-3 {{ Request::routeIs('mis-likes') ? 'text-[#8379BE]' : 'text-gray-700' }}">
                <i class="fa-solid fa-heart text-xl"></i>
            </a>
            <a href="{{ route('chat-list') }}"
                class="menu-item p-3 {{ Request::routeIs('chat-list') ? 'text-[#8379BE]' : 'text-gray-700' }}">
                <i class="fa-solid fa-comments text-xl"></i>
            </a>
            <a href="{{ route('soporte.index') }}" class="menu-item p-3 text-gray-700">
                <i class="fa-solid fa-headset text-xl"></i>
            </a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" class="menu-item p-3 text-gray-700">
                    <i class="fa-solid fa-right-from-bracket text-xl"></i>
                </button>
            </form>
            <livewire:crear-post />
        </nav>
    @endauth
</div>
