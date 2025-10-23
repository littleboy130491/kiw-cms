<section id="coming-soon"
    class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-18 lg:gap-20 lg:w-[1200px] lg:mx-auto">

    <div class="flex flex-col gap-5">
        <h2 class="text-center gradient-blue-text self-center sm:text-[4em] lg:text-[6em] font-bold">
            {{ __('commercial.coming_soon') }}</h2>
        @if ($title)
            <h5 class="text-center -mb-5">{{ $title }}</h5>
        @endif
        @if ($image)
            <div class="coming-soon-image relative rounded-md overflow-hidden">
                <x-curator-glider :media="$image" loading="lazy"/>
            </div>
        @endif
    </div>

</section>