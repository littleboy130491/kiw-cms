@php
    $whistleblowingBlock = [
        'title' => 'Whistleblowing',
        'descTop' => '
        <p>
            Dalam rangka menerapkan tata kelola perusahaan yang baik <b>(Good Corporate Governance)</b> dan
            untuk menciptakan Pejabat dan Karyawan PT KIW yang bersih dan berwibawa, maka diterbitkan Surat
            Keputusan Direksi Nomor : 57/SK/D.KIW/12/2018 tentang kebijakan perusahaan yang mengatur
            tentang <b>Whistle Blowing System</b> (WBS) dan Nomor : 47/SK/D.KIW/11/2018 tentang Pengendalian
            Gratifikasi dan Pembentukan Unit Pengendali Gratifikasi (UPG).
            <br><br>
            WBS adalah system yang mengelola pengaduan/pengungkapan mengenai perilaku melawan hukum,
            perbuatan tidak etis/tidak semestinya secara rahasia, yang digunakan untuk mengoptimalkan peran
            serta Karyawan serta pihak yang berkepentingan dengan PT KIW dan Mitra Bisnis dalam mengungkap
            pelanggaran yang terjadi di lingkungan PT KIW.
            <br><br>
            Disebut Pelapor, yaitu Karyawan/pihak yang berkepentingan serta mitra bisnis PT KIW dan
            Stakeholder lainnya. Identitas pelapor dijamin kerahasiaannya oleh perusahaan dan perusahaan
            menjamin perlindungan terhadap pelapor dari segala bentuk ancaman, intimidasi, hukuman, ataupun
            tindakan tidak menyenangkan dari pihak manapun selama pelapor menjaga kasus yang diadukan kepada
            pihak manapun.
        </p>
        ',
        'image' => Storage::url('media/gratifikasi.jpg'),
        'descBottom' => '
                <p>
                        Tata cara pelaporan dengan membuat pengaduan/pengungkapan dan mengirimkannya ke Pengelola WBS
                        melalui
                        SMS ke <b><a
                                href="https://api.whatsapp.com/send?phone=6281211118021&text=Halo%20PT%20Kawasan%20Industri%20Wijayakusuma,%20saya%20ingin%20pengaduan%20Whistleblowing,"
                                target="_blank">Nomor HP : 081211118021</a></b> atau kirim email ke
                        <b><a href="mailto:wbs@kiw.co.id">wbs@kiw.co.id</a></b> atau anda bisa mengisi form dibawah ini
                        :
                </p>
        '
    ];

    $formBlock = [
        'title' => 'Formulir Pengaduan',
        'desc' => 'Laporkan pelanggaran, keluhan, atau saran secara aman.',
    ];
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

    <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/whistleblowing-hero.jpg')" h1="{!! $item->title ?? 'Whistleblowing' !!}" />

        <!--Start Post Content-->

        <section id="whistleblowing-content"
            class="flex flex-col lg:flex-row gap-18 my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">

            <!--Main Content-->
            <div class="flex flex-col gap-7 lg:gap-9">
                <!--Title-->
                <h2 data-aos="fade-up">
                    {!! $whistleblowingBlock['title'] !!}
                </h2>

                <!--Content-->
                <div class="flex flex-col gap-5">
                    {!! $whistleblowingBlock['descTop'] !!}
                    <!--Image-->
                    <div class="relative">
                        <a class="gallery-item" href="{{ $whistleblowingBlock['image'] }}" data-lightbox="gallery">
                            <img class="rounded-md" src="{{ $whistleblowingBlock['image'] }}">
                        </a>
                    </div>
                    {!! $whistleblowingBlock['descBottom'] !!}

                </div>
            </div>

        </section>

        <!--End Post Content-->

        <!-- Start Form -->
        <section id="whistleblowing-form" class="bg-[var(--color-transit])">

            <!--Start Form-->
            <div class="py-18 lg:py-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-9 lg:w-[1200px] lg:mx-auto">
                <!--title-->
                <div class="flex flex-col gap-5">
                    <h2 data-aos="fade-up" class="text-center">{!! $formBlock['title'] !!}</h2>
                    <p class="text-center">{!! $formBlock['desc'] !!}</p>
                </div>
                <!--form-->
                <livewire:whistleblowing-form />
            </div>

        </section>
        <!--End Form-->





    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
