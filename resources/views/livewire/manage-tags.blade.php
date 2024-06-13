<x-principal>
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}"
        class="bg-white p-6 rounded-lg shadow-md grid gap-4">
        <div class="form-group">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
            <input type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="nombre" wire:model="nombre">
            @error('nombre')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                class="px-4 py-2 bg-[#8379BE] hover:bg-[#6f63a9] focus:ring-4 focus:outline-none focus:ring-[#6f63a9] dark:focus:ring-[#5a4f8c] text-white transition duration-300 ease-in-out">
                {{ $updateMode ? 'Actualizar' : 'Crear' }}
            </button>
            @if ($updateMode)
                <button type="button" wire:click="resetInput"
                    class="px-4 py-2 text-white bg-[#EB497B] hover:bg-[#d63e6d] focus:ring-4 focus:outline-none focus:ring-[#d63e6d] dark:focus:ring-[#b6325a] transition duration-300 ease-in-out">Cancelar</button>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <h2 class="text-2xl font-bold mb-4">Tags</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($tags as $tag)
            <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <span class="text-gray-700">{{ $tag->nombre }}</span>
                <div class="flex space-x-2">
                    <button wire:click="edit({{ $tag->id }})"
                        class="bg-[#8379BE] hover:bg-[#6f63a9] text-white text-xs font-bold py-1 px-3 ">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button wire:click="delete({{ $tag->id }})"
                        class=" bg-[#EB497B] hover:bg-[#d63e6d] text-white text-xs font-bold py-1 px-3 ">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</x-principal>
