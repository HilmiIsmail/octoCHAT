<x-app-layout>
    <x-principal>
        <div class="max-w-4xl mx-auto p-6 rounded-xl shadow-xl bg-white dark:bg-gray-800 dark:text-gray-200">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white text-center">Formulario de Soporte</h2>
            <form method="POST" action="{{ route('soporte.procesar') }}">
                @csrf
                <!-- Nombre -->
                <div class="mb-5">
                    <label for="nombre"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="Tu nombre...">
                    <x-input-error for="nombre" class="italic mt-1" />
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    @auth
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" readonly
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Tu email...">
                    @else
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Tu email...">
                    @endauth
                    <x-input-error for="email" class="italic mt-1" />
                </div>

                <!-- Asunto -->
                <div class="mb-5">
                    <label for="asunto"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asunto</label>
                    <input type="text" id="asunto" name="asunto" value="{{ old('asunto') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="Asunto de tu consulta...">
                    <x-input-error for="asunto" class="italic mt-1" />
                </div>

                <!-- Contenido -->
                <div class="mb-5">
                    <label for="contenido"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenido</label>
                    <textarea id="contenido" name="contenido" rows="5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="Escribe tu consulta aquí...">{{ old('contenido') }}</textarea>
                    <x-input-error for="contenido" class="italic mt-1" />
                </div>

                <!-- Botones de Acción -->
                <div class="flex justify-end gap-4">
                    <button type="reset"
                        class="px-4 py-2 bg-[#E8E2E2] hover:bg-[#c7c1c1] focus:ring-4 focus:outline-none focus:ring-[#c7c1c1] dark:focus:ring-[#E8E2E2] text-black transition duration-300 ease-in-out">
                        <i class="fa-solid fa-broom mr-2"></i> Limpiar
                    </button>
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 text-white bg-[#EB497B] hover:bg-[#d63e6d] focus:ring-4 focus:outline-none focus:ring-[#d63e6d] dark:focus:ring-[#b6325a] transition duration-300 ease-in-out">
                        <i class="fa-solid fa-xmark mr-2"></i> Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] transition duration-300 ease-in-out">
                        <i class="fa-solid fa-paper-plane mr-2"></i>
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </x-principal>
</x-app-layout>
