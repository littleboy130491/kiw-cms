<!--Item-->
<div class="fasilitas-home-item same-height group !grow h-full cursor-pointer swiper-slide !flex flex-col justify-between bg-[var(--color-transit)] overflow-hidden rounded-2xl p-6 pb-0"
    onclick="openModal(this)">
    <div class="mb-10 flex flex-col gap-3">
        <h6 class="numbers">{{ str_pad($iteration, 2, '0', STR_PAD_LEFT) . '.' }}</h6>
        <h4 class="name">{{ $post->title ?? 'Fasilitas Kami' }}</h4>
    </div>

    <x-curator-glider :media="$post->featuredImage" class="rounded-2xl rounded-b-none h-[180px] object-cover self-end w-full" />
    <!-- Hidden-->
    <div class="description hidden">
        {!! $post->content !!}
    </div>
    <x-curator-glider :media="$post->featuredImage" class="photo hidden" />
</div>
