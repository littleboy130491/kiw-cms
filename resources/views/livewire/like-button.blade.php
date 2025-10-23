<div class="flex flex-row gap-1 items-center cursor-pointer" wire:click="toggleLike" wire:loading.attr="disabled"
    wire:target="toggleLike">
    <!-- Unlike state image -->
    <img class="w-[15px] like transition-all duration-200 {{ $hasLiked ? 'hidden' : '' }}"
        src="{{ Storage::url('media/like.png') }}" wire:loading.class="opacity-50" wire:target="toggleLike" loading="lazy"/>

    <!-- Liked state image -->
    <img class="w-[15px] liked transition-all duration-200 {{ $hasLiked ? '' : 'hidden' }}"
        src="{{ Storage::url('media/liked.png') }}" wire:loading.class="opacity-50" wire:target="toggleLike" loading="lazy"/>

    @if ($showCount)
        <span class="text-[var(--color-purple)] transition-all duration-200 sm:text-[.9em] text-[.7em]" wire:loading.class="opacity-50"
            wire:target="toggleLike">
            {{ number_format($likesCount) }} {{ $likesCount == 1 ? 'Like' : 'Likes' }}
        </span>
    @endif

    <!-- Loading indicator (optional) -->
    <span wire:loading wire:target="toggleLike" class="text-[var(--color-purple)] text-sm ml-1">
        ...
    </span>

</div>
