@php
    use App\Models\Career;
    use Littleboy130491\Sumimasen\Enums\ContentStatus;
    $items = Career::with(['careerCategories', 'featuredImage'])
        ->where('status', ContentStatus::Published)
        ->get();
@endphp
<x-layouts.app>
    <x-partials.header />
    <main>

        <x-partials.hero-page :image="$item->featuredImage?->url ?? Storage::url('media/karier-hero.jpg')"
            h1="{{ strip_tags($item->content) ?? 'Lowongan Kerja' }}" />

        <!--Start Karier Content-->

        <section id="karier" class="my-18 lg:my-30 px-4 sm:px-6 lg:px-0 lg:max-w-[1200px] lg:mx-auto">
            @if ($items->isNotEmpty())
                @foreach ($items as $item)
                    <x-loop.accordion-karier :item="$item" />
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