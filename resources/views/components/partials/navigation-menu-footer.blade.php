@props(['menu'])

@foreach ($menu->menuItems as $item)
    <a href="{{ $item->url }}" target="{{ $item->target }}">{{ $item->linkable?->title ?? $item->title }}</a>
@endforeach
