<x-layouts.app title="500">
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="Storage::url('media/bangunan-pabrik-hero.jpg')" h1="Kesalahan Server Internal" />

        <section id="500-page" class="my-18 lg:my-30 mx-4 sm:mx-6 lg:mx-0 text-center flex flex-col items-center gap-5">
            <h6 data-aos="fade-down" class="bullet-1">Error 500</h6>
            <h2 data-aos="fade-top" class="font-bold">Oops! Terjadi Kesalahan di Server</h2>
            <div class="flex flex-col gap-5">
                <p class="sub-p">Kami sedang mengalami gangguan teknis.</p>
                <p>Silakan coba beberapa saat lagi atau hubungi tim teknis kami.</p>
            </div>
            <a class="w-fit btn1 back mt-5" data-aos="fade-down" href="/">
                Kembali ke Home
                <span><x-icon.arrow-back-white /></span>
            </a>
        </section>
    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
