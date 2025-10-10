@php
    use App\Models\Archive;
    use App\Models\Career;

    $record = Archive::where('slug->id', 'karir')->first();
    $karir_archive_url = route('cms.page', [
        'lang' => app()->getLocale(),
        'slug' => 'karir',
    ]);
    $item_image = $item->featuredImage?->url ?? Storage::url('media/content-default.jpg');

    $relatedItems = Career::where('id', '!=', $item->id)
                        ->latest()
                        ->limit(3)
                        ->get();
@endphp


<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="isset($record->featuredImage) ? $record->featuredImage->url : Storage::url('media/karier-hero.jpg')" h1="{{ strip_tags($record->content) ?? ($record->title ?? 'Lowongan Kerja') }}" />

        <section id="single-karier" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto">
            <div class="pb-10 border border-0 border-b-1 border-b-[var(--color-border)] flex flex-col gap-">
                <div class="flex flex-row items-center gap-2">
                    <x-icon.calendar-icon-color />
                    <p class="!text-[var(--color-purple)] text-[.8em]">
                        {{$item->published_at?->format('d M Y') ?? $item->created_at?->format('d M Y')}}
                    </p>          
                </div>
                <h2 data-aos="fade-up">{{ $item->title }}</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-10 mt-10">

                <div class="flex flex-col gap-10 lg:w-1/2">
                    @if($item->content)
                        <div>
                            <h3>
                                {{ __('career.description') }}:
                            </h3>
                            <div class="mt-4">
                                {!! $item->content !!}
                            </div>
                        </div>
                    @endif
                    
                    @if($item->qualifications)
                        <div>
                            <h3>
                                {{ __('career.qualifications') }}:
                            </h3>
                            <div class="mt-4">
                                {!! $item->qualifications !!}
                            </div>
                        </div>
                    @endif

                        <div class="flex flex-col gap-0">
                            @if(str_contains($item->cta, 'mailto:'))
                                <h3>Send your Resume to:</h3>
                            @else
                                <h3>Apply to:</h3>
                            @endif
                            <!--button-->
                            <a class="w-fit btn1 mt-5"data-aos="fade-down" href="{{ $item->cta }}" target="_blank">{{ $item->cta_label ?? 'Apply' }}
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />`
                                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                </span>
                            </a>
                        </div>
                        
                        @if(str_contains($item->cta, 'mailto:'))
                            <div class="flex flex-col gap-5">
                                <h4>Subject Email:</h4>
                                <p class="text-[var(--color-blue)]">{{ $item->careerCategories->first()?->title ?? 'Full Time' }} - {{ $item->title }} - Nama Lengkap</p>
                            </div>
                        @endif


                </div>
                
            
                @if (!empty($item->featured_image))
                <div class="flex flex-col gap-5 lg:w-1/2">
                    <a href="{{ $item->featuredImage?->url }}" data-lightbox="gallery">
                        <x-curator-glider :media="$item->featuredImage" class="w-full object-contain rounded-md" />
                    </a>
                </div>
                @endif

            </div>

        </section>

        <section id="karir-lainnya" class="bg-[var(--color-transit)]">
            <div class="px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto lg:py-30 py-18 flex flex-col gap-8">
                <div class="flex sm:flex-row flex-col gap-5 justify-between">
                    <h2 data-aos="fade-up">Cari Posisi Lainnya</h2>
                    <!--button-->
                    <a class="w-fit btn1 mt-5 !hidden sm:!flex"data-aos="fade-down" href="{{$karir_archive_url}}" target="_blank">Lowongan Lainnya
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />`
                                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                        </span>
                    </a>
                </div>
                <div>
                    <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">
                        @foreach ($relatedItems as $item)
                            <x-loop.karir-grid :item="$item"/>
                        @endforeach
                    </div>
                </div>

                <a class="w-fit btn1 mt-5 sm:!hidden !flex" data-aos="fade-down" href="{{$karir_archive_url}}" target="_blank">Lowongan Lainnya
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />`
                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                    </span>
                </a>
                
                
            </div>
        </section>    

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>