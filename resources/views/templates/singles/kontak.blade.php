<x-layouts.app :title="$title ?? 'Default Page'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/kontak-hero.jpg')" h1="Kontak" />

        <!--Start Informasi Kontak-->
        <section id="informasi-kontak"
            class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 flex flex-col gap-7 lg:gap-10 lg:w-[1200px] lg:mx-auto lg:flex-row">
            <div class="flex flex-col gap-5 lg:w-1/3">
                <h2 data-aos="fade-up">
                    Hubungi Kami
                </h2>
                <p>
                    Jangan ragu untuk menghubungi kami terkait pertanyaan, kerja sama, atau kebutuhan bisnis Anda.
                </p>
                <div class="flex flex-row gap-8 w-[70%] lg:w-full lg:mt-10 sm:mt-5">
                    <a href="{{ config('cms.site_social_media.facebook') }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ Storage::url('media/facebook-blue.png') }}" alt="facebook">
                    </a>
                    <a href="{{ config('cms.site_social_media.twitter') }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ Storage::url('media/twitter-blue.png') }}" alt="twitter">
                    </a>
                    <a href="{{ config('cms.site_social_media.instagram') }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ Storage::url('media/instagram-blue.png') }}" alt="instagram">
                    </a>
                    <a href="{{ config('cms.site_social_media.linkedin') }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ Storage::url('media/linkedin-blue.png') }}" alt="linkedin">
                    </a>
                    <a href="{{ config('cms.site_social_media.youtube') }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ Storage::url('media/youtube-blue.png') }}" alt="youtube">
                    </a>
                </div>
            </div>

            <!--Wrap Items-->
            <div class="grid grid-cols-1 gap-5 lg:w-2/3 sm:grid-cols-2">

                <!--Item-->
                <div data-aos="fade-down"
                    class="group bg-[var(--color-transit)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] flex flex-col justify-start gap-5 p-6 rounded-md">
                    <h5 class="text-[var(--color-purple)] group-hover:text-white">Alamat Kantor</h5>
                    <a class="text-[var(--color-heading)] group-hover:text-white"
                        href="{{ config('cms.site_contact.link_address1') }}" target="_blank"
                        rel="noopener noreferrer">
                        {!! config('cms.site_contact.address1') !!}
                    </a>
                </div>

                <!--Item-->
                <div data-aos="fade-down"
                    class="group bg-[var(--color-transit)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] flex flex-col justify-start gap-5 p-6 rounded-md">
                    <h5 class="text-[var(--color-purple)] group-hover:text-white">Kantor Perwakilan</h5>
                    <a class="text-[var(--color-heading)] group-hover:text-white"
                        href="{{ config('cms.site_contact.link_address2') }}" target="_blank"
                        rel="noopener noreferrer">
                        {!! config('cms.site_contact.address2') !!}
                    </a>
                </div>

                <!--Item-->
                <div data-aos="fade-down"
                    class="group bg-[var(--color-transit)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] flex flex-col justify-start gap-5 p-6 rounded-md">
                    <h5 class="text-[var(--color-purple)] group-hover:text-white">Email</h5>
                    <div class="flex flex-col gap-2">
                        <a class="text-[var(--color-heading)] group-hover:text-white"
                            href="mailto:{{ config('cms.site_contact.email1') }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ config('cms.site_contact.email1') }}
                        </a>
                        <a class="text-[var(--color-heading)] group-hover:text-white"
                            href="mailto:{{ config('cms.site_contact.email2') }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ config('cms.site_contact.email2') }}
                        </a>
                    </div>
                </div>

                <!--Item-->
                <div data-aos="fade-up"
                    class="group bg-[var(--color-transit)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] flex flex-col justify-start gap-5 p-6 rounded-md">
                    <h5 class="text-[var(--color-purple)] group-hover:text-white">Nomor Telepon</h5>
                    <div class="flex flex-col gap-2">
                        <a class="text-[var(--color-heading)] group-hover:text-white phone"
                            href="tel:{{ config('cms.site_contact.phone1') }}" target="_blank"
                            rel="noopener noreferrer">
                            Commercial: {{ config('cms.site_contact.phone1') }}
                        </a>
                        <a class="text-[var(--color-heading)] group-hover:text-white phone"
                            href="tel:{{ config('cms.site_contact.phone2') }}" target="_blank"
                            rel="noopener noreferrer">
                            Office: {{ config('cms.site_contact.phone2') }}
                        </a>
                    </div>
                </div>


            </div>
        </section>

        <!--End Informasi Kontak-->

        <!--Start Map-->

        <section id="map-kontak" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:w-[1200px] lg:mx-auto">
            <iframe class="rounded-md" src="{{ config('cms.site_contact.contact_map') }}" width="100%" height="380"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

        <!--End Map-->

        <!-- Start Form Kontak -->
        <section id="kontak-form" class="bg-[--color-transit]">
            <livewire:contact-form />
        </section>
        <!--End Form Kontak-->

    </main>
    <x-partials.whatsapp />
    <footer>
        <!--Copyrights-->
        <div
            class="text-white gradient-blue-background text-center py-5 border-t-1 border-[var(--color-bordertransparent)] sm:!text-[.9em] !text-[.75em]">
            {{ date('Y') }} © Kawasan Industri Wijayakusuma | Seluruh Hak Cipta Dilindungi
        </div>
    </footer>
</x-layouts.app>
