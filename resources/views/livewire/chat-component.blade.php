<div class="flex h-screen antialiased text-gray-800">
    <div class="flex flex-row h-full w-full overflow-x-hidden">
        <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
            <div class="flex flex-row items-center justify-center h-12 w-full">
                <div class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                </div>
                <div class="ml-2 font-bold text-2xl">Chat</div>
            </div>
            <div
                class="flex flex-col items-center bg-indigo-100 border border-gray-200 mt-4 w-full py-6 px-4 rounded-lg">
                <div class="h-20 w-20 rounded-full border overflow-hidden">
                    <a href="{{ route('perfil.user', $user->id) }}">
                        <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="h-full w-full" />
                    </a>

                </div>
                <div class="text-sm font-semibold mt-2">{{ $user->name }}</div>
                <div class="text-xs text-gray-500">{{ $user->email }}</div>
            </div>
            <div class="flex flex-col mt-8">
                <div class="flex flex-row items-center justify-between text-xs">
                    <span class="font-bold">Active Conversations</span>
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500"></div>
                </div>
                <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48 overflow-y-auto">
                    @foreach ($users as $usuario)
                        <a href="{{ route('chat', $usuario->id) }}"
                            class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                            <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
                                <img src="{{ $usuario->profile_photo_url }}" class="rounded-full h-10 w-12">
                            </div>
                            <div class="ml-2 text-sm font-semibold">{{ $usuario->name }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-auto h-full pb-10">
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                <div id="chat-container" class="flex flex-col h-full overflow-x-auto mb-4">
                    <div class="flex flex-col h-full">
                        <div class="grid grid-cols-12 gap-y-2">
                            @foreach ($messages as $message)
                                @if ($message['sender'] != auth()->user()->name)
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div class="flex items-center justify-center flex-shrink-0">
                                                <img src="{{ $user->profile_photo_url }}"
                                                    class="rounded-full h-10 w-12">
                                            </div>
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                <div>{{ $message['message'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                        <div class="flex items-center justify-start flex-row-reverse">
                                            <div class="flex items-center justify-center flex-shrink-0">
                                                <img src="{{ Auth::user()->profile_photo_url }}"
                                                    class="rounded-full h-12 w-12">
                                            </div>
                                            <div
                                                class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                <div>{{ $message['message'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <form wire:submit='sendMessage'>
                    <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                        <div class="flex-grow ml-4">
                            <div class="relative w-full">
                                <input type="text" wire:model='message'
                                    class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <button type="submit"
                                class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                <span>Enviar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Desplazar hacia abajo el contenedor del chat
    function desplazarHaciaAbajo() {
        var chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Desplazar hacia abajo al cargar la página
    window.onload = function() {
        desplazarHaciaAbajo();
    };
</script>
