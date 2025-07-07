@pushOnce('before_body_close')
    @vite('resources/js/pages/karier.js')
@endPushOnce

<x-layouts.app :title="$title ?? 'Default Page'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/karier-hero.jpg')" h1="Lowongan Kerja" />



        <!--Start Karier Content-->
        <section id="karier" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto">

            <x-loop.accordion-karier label="Staff Pengembangan Kawasan" category="fulltime"
                desc="
        <ul class='list-disc pl-6'>
            <li>Melakukan perencanaan dan pengawasan pengembangan infrastruktur kawasan industri</li>
            <li>Bekerja sama dengan tim teknik dan kontraktor untuk memastikan kualitas proyek</li>
            <li>Menyusun laporan progres pembangunan secara berkala</li>
        </ul>"
                qualification="
        <ul class='list-disc pl-6'>
            <li>Pendidikan minimal S1 Teknik Sipil / Arsitektur</li>
            <li>Pengalaman minimal 2 tahun di bidang serupa</li>
            <li>Mampu mengoperasikan software AutoCAD dan MS Project</li>
        </ul>"
                url="https://www.jobsdb.com/" :image="Storage::url('media/karier-1.jpg')" />

            <x-loop.accordion-karier label="Analis Investasi & Pengembangan Bisnis" category="Freelance"
                desc="
        <ul class='list-disc pl-6'>
            <li>Melakukan perencanaan dan pengawasan pengembangan infrastruktur kawasan industri</li>
            <li>Bekerja sama dengan tim teknik dan kontraktor untuk memastikan kualitas proyek</li>
            <li>Menyusun laporan progres pembangunan secara berkala</li>
        </ul>"
                qualification="
        <ul class='list-disc pl-6'>
            <li>Pendidikan minimal S1 Teknik Sipil / Arsitektur</li>
            <li>Pengalaman minimal 2 tahun di bidang serupa</li>
            <li>Mampu mengoperasikan software AutoCAD dan MS Project</li>
        </ul>"
                url="https://www.jobsdb.com/" :image="Storage::url('media/karier-1.jpg')" />

            <x-loop.accordion-karier label="Analis Investasi & Pengembangan Bisnis" category="Freelance"
                desc="
        <ul class='list-disc pl-6'>
            <li>Melakukan perencanaan dan pengawasan pengembangan infrastruktur kawasan industri</li>
            <li>Bekerja sama dengan tim teknik dan kontraktor untuk memastikan kualitas proyek</li>
            <li>Menyusun laporan progres pembangunan secara berkala</li>
        </ul>"
                qualification="
        <ul class='list-disc pl-6'>
            <li>Pendidikan minimal S1 Teknik Sipil / Arsitektur</li>
            <li>Pengalaman minimal 2 tahun di bidang serupa</li>
            <li>Mampu mengoperasikan software AutoCAD dan MS Project</li>
        </ul>"
                url="https://www.jobsdb.com/" :image="Storage::url('media/karier-1.jpg')" />

            <x-loop.accordion-karier label="Staff Legal & Perizinan" category="Freelance"
                desc="
        <ul class='list-disc pl-6'>
            <li>Melakukan perencanaan dan pengawasan pengembangan infrastruktur kawasan industri</li>
            <li>Bekerja sama dengan tim teknik dan kontraktor untuk memastikan kualitas proyek</li>
            <li>Menyusun laporan progres pembangunan secara berkala</li>
        </ul>"
                qualification="
        <ul class='list-disc pl-6'>
            <li>Pendidikan minimal S1 Teknik Sipil / Arsitektur</li>
            <li>Pengalaman minimal 2 tahun di bidang serupa</li>
            <li>Mampu mengoperasikan software AutoCAD dan MS Project</li>
        </ul>"
                url="https://www.jobsdb.com/" :image="Storage::url('media/karier-1.jpg')" />

            <x-loop.accordion-karier label="Staff Keuangan & Akuntansi" category="Fulltime"
                desc="
        <ul class='list-disc pl-6'>
            <li>Melakukan perencanaan dan pengawasan pengembangan infrastruktur kawasan industri</li>
            <li>Bekerja sama dengan tim teknik dan kontraktor untuk memastikan kualitas proyek</li>
            <li>Menyusun laporan progres pembangunan secara berkala</li>
        </ul>"
                qualification="
        <ul class='list-disc pl-6'>
            <li>Pendidikan minimal S1 Teknik Sipil / Arsitektur</li>
            <li>Pengalaman minimal 2 tahun di bidang serupa</li>
            <li>Mampu mengoperasikan software AutoCAD dan MS Project</li>
        </ul>"
                url="https://www.jobsdb.com/" :image="Storage::url('media/karier-1.jpg')" />


        </section>

        <!--End Karier Content-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
