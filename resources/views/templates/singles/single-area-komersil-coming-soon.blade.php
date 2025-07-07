<x-layouts.app :title="$title ?? 'Default Page'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/bangunan-pabrik-hero.jpg')" h1="Area Komersil" />

        <!--Start Gallery-->

        <section id="coming-soon"
            class="flex flex-col my-18 lg:my-30 px-4 sm:px-6 lg:px-0 gap-18 lg:gap-20 lg:w-[1200px] lg:mx-auto">

            <div class="flex flex-col gap-5">
                <h2 class="text-center gradient-blue-text self-center sm:text-[4em] lg:text-[6em] font-bold">Segera
                    Hadir!</h2>
                <h5 class="text-center -mb-5">Sport Center</h5>
                <div class="comming-soon-image relative rounded-md overflow-hidden">
                    <img src="{{ Storage::url('media/sport-center.jpg') }}">
                </div>
            </div>

        </section>

        <!--End Spesifikasi-->

    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
