<x-layouts.app>
    <x-partials.header />

    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/mengapa-kiw-hero.jpg')"
            h1="{{$item->title ?? 'Mengapa KIW?'}}" />


        <!--Keunggulan-->
        <section id="mengapa-kiw" class="flex flex-col ">

            @foreach($item->section as $block)
                @if($block['type'] === 'section_with_image')
                    <x-loop.keunggulan-item :id="$block['data']['block_id']" :h2="$block['data']['title']"
                        :p="$block['data']['description']" :image="$block['data']['image']" />
                @endif
            @endforeach
        </section>


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>