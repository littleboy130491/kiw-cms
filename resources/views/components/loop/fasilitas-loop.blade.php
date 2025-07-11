@php
    $image_url = optional($item->featuredImage)->url ?? '';
@endphp
<div class="relative">
    <div class="group fasilitas-item flex flex-col justify-end p-6 item-for-popup cursor-pointer rounded-md min-h-70 bg-cover bg-no-repeat"
        style="background-image:url('{{ $image_url }}')" onclick="openModal(this)">

        <h4 class="name z-10 text-white"> {{ $item->title ?? 'Fasilitas Kami' }} </h4>

        <!-- Hidden-->
        <div class="description hidden">
            {!! $item->content !!}
        </div>

        <x-curator-glider :media="$item->featuredImage" class="photo hidden" />
    </div>
</div>
