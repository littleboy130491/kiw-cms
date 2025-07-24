<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/pedoman-hero.jpg')" h1="{!! $item->title ?? 'Pedoman & Tata Kelola' !!}" />
        <!--Pedoman Tata Kelola-->
        <section id="pedoman-tata-kelola" class="flex flex-col ">
            @foreach ($item->block as $block)
                <x-loop.pedoman :h2="$block['data']['title']" :p="$block['data']['description']" :link="$block['data']['url']" :button="$block['data']['button_label']" />
            @endforeach
        </section>

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
