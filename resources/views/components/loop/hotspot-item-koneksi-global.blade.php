<div class="absolute transform -translate-y-1/2" style="top: {{ $top ?? '0' }}%; left: {{ $left ?? '0' }}%">
    <!-- Shadow Ping -->
    <span class="absolute inset-0 rounded-full bg-blue-400 opacity-50 animate-ping pointer-events-none"></span>

    <!-- Flag -->
    <div class="w-5 h-5 rounded-full cursor-pointer z-10 bg-cover bg-center"
        style="background-image: url({{ $flag ?? '' }})" data-tippy-content="<div class='flex flex-col gap-2'> 
            <h5 class='text-white text-[1em]'>{{ $country ?? 'Negara' }}</h5> 
            <p class='text-white text-[.9em] flex flex-row flex-nowrap gap-1'>
                <span>{{ $company ?? '' }}</span>
            </p> 
        </div>">
    </div>
</div>