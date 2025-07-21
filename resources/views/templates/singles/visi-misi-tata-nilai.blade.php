@php
    $blocksCollection = collect($item->section);
    // Get main visi-misi block
    $visiMisiBlock = $blocksCollection->firstWhere('data.block_id', 'visi-misi');

    // Get visi-misi items (numbered items)
    $visiMisiItems = $blocksCollection->where('data.block_id', 'visi-misi-item')->values();

    // Get values (AKHLAK)
    $values = $blocksCollection->where('data.block_id', 'values')->values();
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/visi-misi-hero.jpg')"
            h1="{!! $item->title ?? 'Visi Misi & Tata Nilai' !!}" />

        <!--Start About Visi Misi-->
        <section id="about-visi-misi" class="bg-cover bg-no-repeat bg-left sm:bg-cover"
            style="background-image:url({{ Storage::url('media/visi-misi-image.jpg') }})">
            <div class="flex flex-col grow  gradient-white-visi-misi">
                <div
                    class="gradient-white-visi-misi-bottom pb-42 sm:pb-70 lg:pb-130 pt-18 px-4 sm:px-6 lg:px-0 lg:pt-30">
                    <div class="lg:w-[1200px] lg:mx-auto flex flex-col gap-5 sm:flex-row sm:justify-between">
                        @if($visiMisiBlock)
                            <div class="sm:w-1/3 lg:w-[35%] flex flex-col gap-5">
                                <h2 data-aos="fade-up">{{ $visiMisiBlock['data']['title'] }}</h2>
                                <p>{!! $visiMisiBlock['data']['description'] !!}</p>
                            </div>
                        @endif

                        <!--Wrap Items-->
                        @if($visiMisiItems->isNotEmpty())
                            <div class="grid grid-cols-1 gap-5 sm:w-2/3 lg:w-[60%] sm:grid-cols-2">
                                @foreach($visiMisiItems as $item)
                                    <!--Item-->
                                    <div
                                        class="group backdrop-blur-sm bg-[var(--white-transparent)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] flex flex-col justify-between gap-5 p-4 rounded-md">
                                        <h6 data-aos="fade-down" class="text-[var(--color-gray)] group-hover:text-white">
                                            {{ $item['data']['title'] }}
                                        </h6>
                                        <p class="text-[var(--color-heading)] group-hover:text-white">
                                            {!! $item['data']['description'] !!}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!--End About Visi Misi-->

        <!--Start Tata Nilai-->
        @if($values->isNotEmpty())
            <section id="tata-nilai"
                class="lg:w-[1200px] lg:mx-auto flex flex-col lg:flex-row gap-9 lg:gap-0 mb-18 lg:mb-30 px-4 sm:px-6 lg:px-0">
                @foreach($values as $index => $value)
                    <!--item-->
                    <div class="group flex flex-col lg:w-1/6 lg:gap-2">
                        <h3 data-aos="fade-up"
                            class="text-[3em] font-bold text-transparent bg-clip-text bg-[var(--color-gray)] group-hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)]">
                            {{ $value['data']['title'] }}
                            </h2>
                            <div
                                class="grow bg-[var(--color-transit)] p-4 sm:p-6 lg:p-5 rounded-md lg:rounded-r-none flex flex-col gap-3 group-hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)]">
                                @if(!empty($value['data']['subtitle']))
                                    <h4 data-aos="fade-down" class="group-hover:text-white">{{ $value['data']['subtitle'] }}</h4>
                                @endif
                                @if(!empty($value['data']['description']))
                                    <p class="group-hover:text-white">{!! $value['data']['description'] !!}</p>
                                @endif
                            </div>
                    </div>

                @endforeach

            </section>
        @endif
        <!--End Tata Nilai-->



    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>