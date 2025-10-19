<x-layouts.app title="403">
    <x-partials.header />
    <main>
        <x-partials.hero-page :image="Storage::url('media/bangunan-pabrik-hero.jpg')" h1="Akses Ditolak" />

        <section id="403-page" class="my-18 lg:my-30 mx-4 sm:mx-6 lg:mx-0 text-center flex flex-col items-center gap-5">
            <h6 data-aos="fade-down" class="bullet-1">Error 403</h6>
            <h2 data-aos="fade-top" class="font-bold">Oops! Anda Tidak Memiliki Akses</h2>
            <div class="flex flex-col gap-5">
                <p class="sub-p">Maaf, Anda tidak diizinkan mengakses halaman ini.</p>
                <p>Silakan kembali atau hubungi administrator jika Anda yakin ini kesalahan.</p>
            </div>
            <a class="w-fit btn1 back mt-5" data-aos="fade-down" href="/">
                {{ __('common.back_to_home') }}
                <span><x-icon.arrow-back-white /></span>
            </a>
        </section>
    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>