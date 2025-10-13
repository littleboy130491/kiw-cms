@php
    $blocksCollection = collect($componentData->block);
    $prefooterBlock = $blocksCollection->firstWhere('data.block_id', 'prefooter');
    $prefooterTitle = $prefooterBlock['data']['title'] ?? 'Mulai Investasi Anda di Kawasan Industri Strategis!';
@endphp

<div class="mb-15">
    <h2 class="!text-white lg:w-[850px] sm:w-[500px] footer" data-aos="fade-up">{{ $prefooterTitle }}</h2>
</div>