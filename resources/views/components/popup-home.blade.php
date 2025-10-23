@if ($shouldShow)
    <div id="popup-home" class="fixed inset-0 bg-[#151918de] bg-opacity-50 flex items-center justify-center z-9999 hidden">
        <div class="bg-white sm:p-4 p-2 rounded-lg shadow-lg lg:max-w-[900px] sm:max-w-[87%] w-full relative">
            <button onclick="closePopup()"
                class="absolute sm:-top-9 sm:-right-6 -top-13 -right-0 text-white text-[2em] cursor-pointer">&times;</button>
            @if ($url)
                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                    <img class="h-auto" src="{{ Storage::url($image) }}" alt="{{ $alt }}" class="rounded-lg"/>
                </a>
            @else
                <img class="h-auto" src="{{ Storage::url($image) }}" alt="{{ $alt }}" class="rounded-lg"/>
            @endif
        </div>
    </div>
@endif
