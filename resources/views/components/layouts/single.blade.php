@props([
    'title' => null,
    'description' => null,
    'bodyClasses' => '',
    'showBreadcrumb' => true,
    'showSidebar' => false,
    'showSocialShare' => true,
    'showInstagram' => true,
])

<x-layouts.page 
    :title="$title" 
    :description="$description" 
    :body-classes="$bodyClasses"
>
    {{-- Header KIW for single pages --}}
    <x-components.header-kiw />
    
    {{-- Breadcrumb Navigation --}}
    @if($showBreadcrumb && isset($breadcrumb))
        <x-ui.breadcrumb :items="$breadcrumb" />
    @endif
    
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 {{ $showSidebar ? 'lg:grid-cols-3' : '' }} gap-8">
            {{-- Main Content --}}
            <div class="{{ $showSidebar ? 'lg:col-span-2' : '' }}">
                {{ $slot }}
                
                {{-- Social Share --}}
                @if($showSocialShare)
                    <x-ui.social-share />
                @endif
            </div>
            
            {{-- Sidebar --}}
            @if($showSidebar)
                <aside class="lg:col-span-1">
                    {{ $sidebar ?? '' }}
                    
                    {{-- Instagram Feed --}}
                    @if($showInstagram)
                        <x-ui.behold-ig-feed />
                    @endif
                </aside>
            @endif
        </div>
    </div>
</x-layouts.page>