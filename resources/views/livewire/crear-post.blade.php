<div class="pt-3">
    <a wire:click="$set('openCrear', true)"
        class="flex items-center space-x-2 bg-[#8379BE] text-white px-4 py-2 shadow-md hover:bg-[#6e68a0] transition duration-300 cursor-pointer">
        <i class="fa-solid fa-circle-plus"></i>
        <span>Crear</span>
    </a>



    <x-dialog-modal wire:model='openCrear' class="bg-white  shadow-xl">
        <x-slot name="title" class="text-lg font-bold text-gray-900">
            NUEVO POST
        </x-slot>
        <x-slot name="content">
            {{-- CONTENIDO --}}
            <div class="mb-4">
                <label for="contenido" class="block font-bold text-gray-700">Contenido del Artículo</label>
                <textarea id="contenido" rows="4" placeholder="Contenido..." wire:model="contenido"
                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                <x-input-error for="contenido" />
            </div>

            {{-- TAGS --}}
            <div class="mb-4">
                <label for="tag_id" class="block font-bold text-gray-700">Los tags</label>
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($misTags as $item)
                        <div class="flex items-center">
                            <input id="tag_{{ $item->id }}" type="checkbox" value="{{ $item->id }}"
                                wire:model="tags" class="focus:ring-blue-500 border-gray-300 rounded mr-2">
                            <label for="tag_{{ $item->id }}" class="text-gray-700">#{{ $item->nombre }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error for="tags" />
            </div>

            {{-- ESTADO --}}
            <div class="mb-4 flex items-center">
                <input id="estado1" type="checkbox" value="PUBLICADO" wire:model="estado"
                    class="appearance-none border-2 border-gray-500 rounded-md w-6 h-6 transition-colors duration-300 cursor-pointer checked:bg-[#756AB6]">
                <label for="estado1" class="ml-2 font-bold text-gray-700">Publicar artículo</label>
            </div>

            {{-- IMAGEN --}}
            <div class="mb-4 border-dashed border-2 border-gray-300 rounded-md">
                <label for="imagen1" class="block font-bold text-gray-700">Imagen del artículo</label>
                <div class="relative w-full h-96">
                    <input type="file" accept="image/*" id="imagen1" hidden wire:model="imagen" />
                    <div class="bg-gray-200 h-full w-full rounded-md flex justify-center items-center">
                        @if ($imagen)
                            <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen del artículo"
                                class="h-full w-full object-cover">
                        @else
                            <span class="text-gray-500">Selecciona una imagen</span>
                        @endif
                    </div>
                    <label for="imagen1"
                        class="absolute bottom-2 right-2 px-4 py-2 text-black bg-[#ddd] hover:bg-[#b8b8b8] focus:ring-4 focus:outline-none focus:ring-[#b8b8b8] dark:focus:ring-[#c3c2c2] transition duration-300 ease-in-out">
                        <i class="fa-solid fa-cloud-arrow-up mr-1"></i>Upload</label>
                </div>
                <x-input-error for="imagen" />
            </div>
        </x-slot>

        <x-slot name="footer" class="flex justify-end">
            <button wire:click="store"
                class="px-4 py-2 text-white bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] transition duration-300 ease-in-out mr-3">
                <i class="fas fa-save mr-1"></i> GUARDAR
            </button>
            <button wire:click="limpiarCrear"
                class="px-4 py-2 text-white bg-[#EB497B] hover:bg-[#d63e6d] focus:ring-4 focus:outline-none focus:ring-[#d63e6d] dark:focus:ring-[#b6325a] transition duration-300 ease-in-out">
                <i class="fas fa-times mr-1"></i> CANCELAR
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
