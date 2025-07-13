@props([
    'item' => ''
])
<!--item-->
<div data-aos="fade-down"
    class="group item-for-popup flex flex-col justify-between gap-9 cursor-pointer bg-[var(--color-transit)] hover:bg-[linear-gradient(268deg,_#1F77D3_1.1%,_#321B71_99.1%)] rounded-md px-6 pt-6 sm:pt-6 transition"
    onclick="openModal(this)">
    <div class="flex flex-col gap-5">
        <h6
            class="position w-fit text-transparent bg-clip-text bg-gradient-to-r from-[#1F77D3] to-[#321B71] group-hover:text-white group-hover:bg-none">
            {{ $item->position ?? '' }}
        </h6>

        <h4 class="name group-hover:text-white"> {{ $item->title ?? '' }} </h4>
    </div>

    <x-curator-glider :media="$item->featuredImage" class="photo rounded-t-md" />

    <!-- Hidden Description -->
    <div class="description hidden">
        {!! $item->content !!}
    </div>
</div>