<div>
    <button wire:click="like" class="flex items-center focus:outline-none text-gray-600">
        <i
            class="fa-solid fa-heart {{ $post->likedByUsers->contains(auth()->id()) ? 'text-red-600' : 'text-gray-600' }}"></i>
        <span class="ml-2">{{ $post->likedByUsers()->count() }}</span>
    </button>
</div>
