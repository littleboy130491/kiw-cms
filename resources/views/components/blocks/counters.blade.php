@props(['data'])

@php
    $title = $data['title'] ?? '';
    $counters = $data['counters'] ?? [];
@endphp

@if(!empty($counters))
{{-- Check if this is hero counters (has title) or about counters (no title) --}}
@if(!empty($title))
    {{-- Hero Counters --}}
    <div class="counter-hero-home flex flex-row flex-wrap justify-between lg:w-[1200px] lg:mx-auto sm:gap-0 gap-y-5 mt-5 lg:px-0 sm:px-6 px-4">
        <div class="lg:w-1/5 sm:w-1/5 w-full self-center">
            <h5 class="text-white">{{ $title }}</h5>
        </div>
        @foreach($counters as $counter)
        <x-loop.counter-hero-home 
            counter="{{ $counter['number'] ?? '0' }}" 
            unit="{{ $counter['unit'] ?? '' }}"
            label="{{ $counter['label'] ?? '' }}" />
        @endforeach
    </div>
@else
    {{-- About Section Counters --}}
    <div class="grid grid-cols-2 gap-8">
        @foreach($counters as $counter)
        <x-loop.counter-about-home 
            counter="{{ $counter['number'] ?? '0' }}" 
            label="{{ $counter['label'] ?? '' }}" />
        @endforeach
    </div>
@endif
@endif