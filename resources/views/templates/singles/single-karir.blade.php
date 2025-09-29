<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/karier-hero.jpg')"
            h1="Lowongan Kerja" />

        <section id="single-karier" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto">
            <div class="pb-10 border border-0 border-b-1 border-b-[var(--color-border)]">
                <h2 data-aos="fade-up">Lowongan Auditor 2 PT Kawasan Industri Wijayakusuma</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-10 mt-10">

                <div class="flex flex-col gap-5">
                    <a href="{{ Storage::url('media/karier-1.jpg') }}" data-lightbox="gallery">
                        <img src="{{ Storage::url('media/karier-1.jpg') }}" class="w-full object-contain rounded-md">
                    </a>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-15">
                        <div class="flex flex-col gap-5">
                            <h4>Deskripsi Pekerjaan</h4>
                            <ul class="list-disc pl-6">
                                <li>Melakukan perencanaan dan pengawasan pengembangan infrastruktur kawasan industri</li>
                                <li>Bekerja sama dengan tim teknik dan kontraktor untuk memastikan kualitas proyek</li>
                                <li>Menyusun laporan progres pembangunan secara berkala</li>
                            </ul>
                        </div>
                        <div class="flex flex-col gap-5">
                            <h4>Kualifikasi</h4>
                            <ul class="list-disc pl-6">
                                <li>Pendidikan minimal S1 Teknik Sipil / Arsitektur</li>
                                <li>Pengalaman minimal 2 tahun di bidang serupa</li>
                                <li>Mampu mengoperasikan software AutoCAD dan MS Project</li>
                            </ul>
                        </div>

                        <div>
                            <h4>Send your Resume to:</h4>
                            <!--button-->
                            <a class="w-fit btn1 mt-5"data-aos="fade-down" href="{{ $item->cta ?? '' }}" target="_blank">Lamar
                                Pekerjaan
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

                </div>
                
            </div>

        </section>

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>