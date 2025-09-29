@php
    $karier = [
                [
                    'title' => 'Staff Pengembangan Kawasan',
                    'slug' => 'staff-pengembangan-kawasan',
                    'image' => Storage::url('media/karier-1.jpg'),
                ],

                [
                    'title' => 'Analis Investasi & Pengembangan Bisnis',
                    'slug' => 'analis-investasi-pengembangan-bisnis',
                    'image' => Storage::url('media/karier-1.jpg'),
                ],

                [
                    'title' => 'Staff Legal & Perizinan',
                    'slug' => 'staff-legal-perizinan',
                    'image' => Storage::url('media/karier-1.jpg'),
                ],
            ];
      //  $url = route('cms.single.content', [app()->getLocale(), 'karir', $item['slug']]);
        $url = 'single-karier';  
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/karier-hero.jpg')"
            h1="Lowongan Kerja" />

        <!--Start Karier Content-->

        <section id="karier" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto flex flex-col gap-8">

            <h2 data-aos="fade-up">Cari Posisi yang Tersedia</h2>
    
            <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">
        
                @foreach ($karier as $item)
                  <x-loop.karier-grid :title="$item['title']" :url="$url" :image="$item['image']"/>
                @endforeach
            </div>
        </section>

        <!--End Karier Content-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>