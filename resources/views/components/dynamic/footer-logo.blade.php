@php
    $blocks = collect($componentData->block)->first();
    $logos= $blocks['data']['gallery'];
@endphp

@foreach($logos as $logo)
      <x-curator-glider :media="$logo" class="sm:w-full w-24" />
@endforeach