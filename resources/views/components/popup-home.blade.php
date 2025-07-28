@if ($shouldShow)
    <div id="popup-home" class="fixed inset-0 bg-[#151918de] bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-sm w-full relative">
            <button onclick="closePopup()"
                class="absolute sm:-top-9 sm:-right-6 -top-13 -right-0 text-white text-[2em] cursor-pointer">&times;</button>
            <img src="{{ Storage::url($image) }}" alt="{{ $alt }}" class="rounded-lg" />
        </div>
    </div>
@endif
