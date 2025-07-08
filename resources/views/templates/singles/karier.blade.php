@pushOnce('before_body_close')
    @vite('resources/js/pages/karier.js')
@endPushOnce
@php
    use App\Models\Career;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;
    $posts = Career::with('careerCategories')->where('status', ContentStatus::Published)->get();
@endphp
<x-layouts.app :title="$title ?? 'Default Page'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="Storage::url('media/karier-hero.jpg')" h1="Lowongan Kerja" />

        <!--Start Karier Content-->

        <section id="karier" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto">
            @if ($posts->isNotEmpty())
                @foreach ($posts as $post)
                    <x-loop.accordion-karier :post="$post" />
                @endforeach
            @else
                <x-partials.post-not-found />
            @endif

        </section>

        <!--End Karier Content-->


    </main>
    <x-partials.whatsapp />
    <x-partials.footer />
</x-layouts.app>
