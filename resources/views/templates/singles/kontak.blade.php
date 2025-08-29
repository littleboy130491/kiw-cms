@php
    $heroPage = [
        'title' => 'Kontak',
        'background' => Storage::url( 'media/kontak-hero.jpg'),
    ];
    $contactBlock = [
        'titleContact' => [
            'title' => 'Hubungi Kami',
            'desc' => 'Jangan ragu untuk menghubungi kami terkait pertanyaan, kerja sama, atau kebutuhan bisnis Anda.',
        ],
        'socialMedia' => [
            [
                'link' => config('cms.site_social_media.facebook'),
                'image' => Storage::url('media/facebook-blue.png'),
            ],
            [
                'link' => config('cms.site_social_media.twitter'),
                'image' => Storage::url('media/twitter-blue.png'),
            ],
            [
                'link' => config('cms.site_social_media.instagram'),
                'image' => Storage::url('media/instagram-blue.png'),
            ],
            [
                'link' => config('cms.site_social_media.linkedin'),
                'image' => Storage::url('media/linkedin-blue.png'),
            ],
            [
                'link' => config('cms.site_social_media.youtube'),
                'image' => Storage::url('media/youtube-blue.png'),
            ],
        ],
        'contactInformation' => [
            [
                'title' => 'Alamat Kantor',
                'item' => [
                    [
                        'link' => config('cms.site_contact.link_address1'),
                        'label' => '',
                        'desc' => config('cms.site_contact.address1'),
                    ],
                ]
            ],
            [
                'title' => 'Kantor Perwakilan',
                'item' => [
                    [
                        'link' => config('cms.site_contact.link_address2'),
                        'label' => '',
                        'desc' => config('cms.site_contact.address2'),
                    ],
                ]
            ],
            [
                'title' => 'Email',
                'item' => [
                    [
                        'link' => config('cms.site_contact.email1'),
                        'label' => '',
                        'desc' => config('cms.site_contact.email1'),
                    ],
                    [
                        'link' => config('cms.site_contact.email2'),
                        'label' => '',
                        'desc' => config('cms.site_contact.email2'),
                    ],
                ]
            ],
            [
                'title' => 'Nomor Telepon',
                'item' => [
                    [
                        'link' => config('cms.site_contact.phone1'),
                        'label' => 'Commercial:',
                        'desc' => config('cms.site_contact.phone1'),
                    ],
                    [
                        'link' => config('cms.site_contact.phone2'),
                        'label' => 'Office:',
                        'desc' => config('cms.site_contact.phone2'),
                    ],
                ]
            ],
        ],
        'contactMap' => config('cms.site_contact.contact_map'),
        'contactForm' => [
            'title' => 'Mari Bergabung dengan KIW',
            'desc' => 'Gabung sekarang dan temukan berbagai kemudahan serta peluang bisnis strategis bersama KIW.',
        ],
    ];
    
@endphp


<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$heroPage['background']" h1="{{ $heroPage['title'] }}" />


        <!--Start Informasi Kontak-->
        <section id="informasi-kontak"
            class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-10 lg:w-[1200px] lg:mx-auto lg:flex-row">
            <div class="flex flex-col gap-5 lg:w-1/3">
                <h2 data-aos="fade-up">
                    {!! $contactBlock['titleContact']['title'] !!}
                </h2>
                <p>
                    {!! $contactBlock['titleContact']['desc'] !!}
                </p>
                <div class="flex flex-row gap-8 w-[70%] lg:w-full lg:mt-10 sm:mt-5">
                    @foreach ($contactBlock['socialMedia'] as $item)
                        <a href="{{ $item['link'] }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $item['image'] }}" alt="facebook">
                        </a>
                    @endforeach
                </div>
            </div>

            <!--Wrap Items-->
            <div class="grid grid-cols-1 gap-5 lg:w-2/3 sm:grid-cols-2">
            @foreach ($contactBlock['contactInformation'] as $item)
            <!--Item-->
                <div data-aos="fade-up"
                    class="group bg-[var(--color-transit)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] flex flex-col justify-start gap-5 p-6 rounded-md">
                    <h5 class="text-[var(--color-purple)] group-hover:text-white">{{ $item['title'] }}</h5>
                    <div class="flex flex-col gap-2">
                        @foreach ($item['item'] as $contact)
                        <a class="text-[var(--color-heading)] group-hover:text-white phone"
                            href="tel:{{ $contact['link'] }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ $contact['label'] }} {!! $contact['desc'] !!}
                        </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

            </div>
        </section>

        <!--End Informasi Kontak-->

        <!--Start Map-->

        <section id="map-kontak" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
            <iframe class="rounded-md" src="{{ $contactBlock['contactMap'] }}" width="100%" height="380"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

        <!--End Map-->

        <!-- Start Form Kontak -->
        <section id="kontak-form" class="bg-[var(--color-transit)]">
            <div class="py-18 lg:py-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-9 lg:w-[1200px] lg:mx-auto">
                <!--title-->
                <div class="flex flex-col gap-5">
                    <h2 data-aos="fade-up" class="text-center">{{ $contactBlock['contactForm']['title'] }}</h2>
                    <p class="text-center">{{ $contactBlock['contactForm']['desc'] }}</p>
                </div>

                <livewire:contact-form />
            </div>
        </section>
        <!--End Form Kontak-->

    </main>
    <x-partials.whatsapp />
    <footer id="footer-kontak">
        <!--Copyrights-->
        <div
            class="text-white gradient-blue-background text-center py-5 border-t-1 border-[var(--color-bordertransparent)] sm:!text-[.9em] !text-[.75em]">
            {{ date('Y') }} © Kawasan Industri Wijayakusuma | Seluruh Hak Cipta Dilindungi
        </div>
    </footer>
</x-layouts.app>