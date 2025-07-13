@props(['location' => 'header'])

@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;

    // Get current language from URL segment (first segment after domain)
    $currentLang = request()->segment(1);

    // Validate if it's a valid language from your config
    $availableLanguages = array_keys(config('cms.language_available', []));
    if (!in_array($currentLang, $availableLanguages)) {
        $currentLang = config('cms.default_language', 'en'); // fallback to default
    }

    $localizedLocation = $location . '_' . $currentLang;
    $fallbackLocation = $location . '_' . config('cms.default_language', 'en');

    $menu = Menu::query()
        ->where('is_visible', true)
        ->whereHas('locations', function ($query) use ($localizedLocation, $fallbackLocation, $location) {
            $query->whereIn('location', [$localizedLocation, $fallbackLocation, $location]);
        })
        ->with([
            'menuItems.linkable',
            'menuItems.children.linkable',
            'menuItems.children.children.linkable' // Add more levels if needed
        ])
        ->orderByRaw("CASE 
                                                                    WHEN EXISTS (SELECT 1 FROM menu_locations WHERE menu_locations.menu_id = menus.id AND menu_locations.location = ?) THEN 1
                                                                    WHEN EXISTS (SELECT 1 FROM menu_locations WHERE menu_locations.menu_id = menus.id AND menu_locations.location = ?) THEN 2
                                                                    ELSE 3
                                                                END", [$localizedLocation, $fallbackLocation])
        ->first();
@endphp

<!--Start Header Menu-->
<div x-data="{ open: false, openSubMenu: null }" x-effect="document.body.classList.toggle('off-canvas-open', open)">

    <header class="absolute top-0 left-1/2 -translate-x-1/2 w-full lg:w-[1200px] z-50 lg:p-0 sm:p-6 px-4 pt-2">
        <div class="lg:max-w-[1200px] mx-auto flex lg:pt-5 sm:pt-1 pt-1 justify-between gap-10">

            <!--Logo-->
            <div class=" flex items-center ">
                <a href="/"><img class="!w-12 sm:!w-14 lg:!w-20 mr-20 filter brightness-0 invert"
                        src="{{ Storage::url('media/logo.png') }}" alt="logo"></a>
            </div>

            <div class="flex flex-col justify-between w-full grow">

                <!--Above Header-->
                <div class="hidden lg:flex lg:flex-row lg:justify-end gap-5">

                    <!--Button-->
                    <a class=" btn5 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                        Hubungi Kami
                        <span class="gradient-icon">
                            <x-icon.pencil />
                        </span>
                    </a>

                    <a class=" btn5 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                        Unduh Brosur
                        <span class="gradient-icon">
                            <x-icon.download-icon-current />
                        </span>
                    </a>

                    <!--Translate-->
                    <x-partials.lang-switcher />

                </div>

                <!--Main Menu-->
                @if ($menu && $menu->menuItems)
                    <x-partials.navigation-menu-header :menu="$menu" />
                @endif


            </div>




            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex flex-col justify-center">
                <button @click="open = !open;" class="text-white focus:outline-none cursor-pointer">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Off-canvas Mobile Menu -->
            <div x-show="open" class="fixed inset-0 bg-black h-[100vh] bg-opacity-50 z-40 lg:hidden"
                @click="open = false"></div>

            <div x-show="open"
                class="fixed top-0 right-0 w-[90%] h-[100vh] bg-cover shadow-lg z-50 transform transition-transform duration-300 ease-in-out lg:hidden"
                style="background-image: linear-gradient(90deg, rgba(255, 255, 255, 0.95) 10%, rgba(255, 255, 255, 0.45) 100%), url({{ Storage::url('media/about-image.jpg') }});"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

                <div class="px-6 mt-5">
                    <button @click="open = false" class="text-[var(--color-heading)] float-right">
                        ✕
                    </button>

                    <div class="pt-10 overflow-y-auto max-h-[95vh] scrollbar-hide">

                        <!--Logo-->
                        <div class=" flex items-center ">
                            <a href="/"><img class="w-15" src="{{ Storage::url('media/logo.png') }}" alt="logo"></a>
                        </div>

                        @if ($menu && $menu->menuItems)
                            <x-partials.navigation-menu-header-mobile :menu="$menu" />
                        @endif


                        <!-- Button -->
                        <div class="mt-10 flex flex-col gap-5">
                            <a class=" btn9 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                                Hubungi Kami
                                <span class="gradient-icon">
                                    <x-icon.pencil />
                                </span>
                            </a>

                            <a class=" btn9 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                                Unduh Brosur
                                <span class="gradient-icon">
                                    <x-icon.download-icon-current />
                                </span>
                            </a>
                        </div>

                        <!--Lang switcher mobile-->
                        <x-partials.lang-switcher-mobile />

                    </div>
                </div>
            </div>

    </header>
</div>
<!--End Header Menu-->