@php
    $tender_archive_url = route('cms.archive.content', [
        'lang' => app()->getLocale(),
        'content_type_archive_key' => 'tenders',
    ]);
@endphp

<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/pengadaan-hero.jpg')" h1="Pengadaan Barang & Jasa" />

        <!--Start About Pengadaan-->
        <section id="about-pengadaan" class="relative bg-contain bg-no-repeat bg-bottom z-10"
            style="background-image:url({{ Storage::url('media/pengadaan-content.jpg') }})">
            <div class="flex flex-col grow gradient-pengadaan-top">
                <div
                    class="gradient-white-visi-misi-bottom pb-70 sm:pb-80 lg:pb-200 pt-18 px-4 sm:px-6 lg:px-0 lg:pt-30">
                    <div class="lg:w-[1200px] lg:mx-auto flex flex-col lg:flex-row gap-5 sm:justify-between">
                        <div class="lg:w-[37%] flex flex-col gap-5">
                            <h2 data-aos="fade-up">Selamat Datang di E-Procurement KIW</h2>
                        </div>

                        <!--Wrap Items-->
                        <div class="flex flex-col gap-5 lg:w-[58%] sm:grid-cols-2">

                            <p>
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum
                                egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper
                                vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
                                himenaeos.
                                <br><br>
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum
                                egestas.
                            </p>
                            <a class="w-fit btn1 mt-5" data-aos="fade-down" href="https://www.pengadaan.com/home"
                                target="_blank" rel="noopener noreferrer">kunjungi pengadaan
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--End About Pengadaan-->

        <!--Start Section Peringatan-->
        <section data-aos="fade-up" id="peringatan"
            class="relative sm:px-6 lg:px-0 sm:-mt-20 lg:-mt-25 lg:w-[1200px] lg:mx-auto z-20">
            <div class="bg-cover px-4 sm:px-6 pt-18 sm:pt-0 lg:px-10 flex flex-col sm:rounded-lg justify-between sm:flex-row gap-8"
                style="background-image:url('{{ Storage::url('media/gradient-pengadaan.jpg') }}')">
                <div class="flex flex-col gap-5 sm:w-2/3 lg:w-1/2 sm:py-9 lg:self-center">
                    <h3 class="text-white">HATI-HATI TERHADAP PENIPUAN!</h3>
                    <p class="text-white">
                        PT Kawasan Industri Wijayakusuma (Persero) mengimbau kepada seluruh calon penyedia barang dan
                        jasa untuk selalu waspada terhadap upaya penipuan yang mengatasnamakan perusahaan.
                        <br><br>
                        Kami tidak pernah memungut biaya dalam bentuk apa pun, termasuk permintaan transfer uang, baik
                        dalam proses pendaftaran Vendor Management System (VMS) maupun selama proses pengadaan barang
                        dan jasa berlangsung.
                    </p>
                </div>
                <img class="object-contain sm:w-1/3 lg:w-1/2 sm:self-end sm:-ml-5 lg:-ml-0 lg:-mt-20"
                    src="{{ Storage::url('media/bad-guy.png') }}">
            </div>
        </section>
        <!--End Section Peringatan-->

        <!-- Start Panduan Pengadaan -->
        <section id="panduan-pengadaan"
            class="lg:my-30 my-18 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-9 lg:w-[1200px] lg:mx-auto">

            <!--Heading-->
            <div class="flex flex-col justify-start gap-5">
                <h6 data-aos="fade-down" class="bullet-1 sm:text-center text-left sm:self-center">panduan pengadaan</h6>
                <h2 data-aos="fade-up" class="sm:text-center text-left">Panduan Lengkap Proses Pengadaan</h2>
            </div>
            <x-loop.panduan-pengadaan-grid />


        </section>
        <!-- End Panduan Pengadaan -->

        <!--Start Pengadaan-->
        <section id="pengadaan" class="lg:py-30 py-18 bg-cover bg-[var(--color-transit)]">
            <div
                class="flex flex-col overflow-hidden relative lg:gap-11 sm:gap-7 gap-7  lg:px-0 lg:lg:max-w-[1200px] lg:mx-auto sm:px-6 px-4">

                <!--Heading-->
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-start gap-5">
                        <h6 data-aos="fade-down" class="bullet-1 sm:text-left text-left">Pengadaan terbaru</h6>
                        <h2 data-aos="fade-up" class="sm:text-center text-left">Pengadaan yang Sedang Berlangsung</h2>
                    </div>
                    <!--button Desktop Tablet-->
                    <a class="w-fit btn1 self-end mt-5 sm:!flex !hidden" data-aos="fade-down"
                        href="{{ $tender_archive_url }}">lihat
                        semua
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                </div>


                <!--Content-->
                <x-loop.tender-grid qty="4" />
                <!--button mobile only-->
                <a class="w-fit btn1 mobile-only mt-7 lg:hidden" data-aos="fade-down"
                    href="{{ $tender_archive_url }}">Lihat Semua
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>


            </div>
        </section>
        <!--End Pengadaan-->



    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>