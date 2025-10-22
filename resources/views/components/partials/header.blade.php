@props(['location' => 'header'])

@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;

    $logo_url = Storage::url('media/' . app('settings')->site_logo ?? 'logo.png');

    $currentLang = app()->getLocale();
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
        ->with(['menuItems.linkable', 'menuItems.children.linkable', 'menuItems.children.children.linkable'])
        ->orderByRaw(
            "CASE WHEN EXISTS (SELECT 1 FROM menu_locations WHERE menu_locations.menu_id = menus.id AND menu_locations.location = ?) THEN 1
                    WHEN EXISTS (SELECT 1 FROM menu_locations WHERE menu_locations.menu_id = menus.id AND menu_locations.location = ?) THEN 2
                    ELSE 3
                    END",
            [$localizedLocation, $fallbackLocation],
        )
        ->first();

        // Revisi penambahan fungsi editing logo
        $logoSize = [
            'desktopWidth' => '76',
            'tabletWidth'  => '56',    
            'mobileWidth'  => '46',
        ];
      
@endphp


<style>
    .logo-img {
        width: {{ $logoSize['mobileWidth'] }}px !important;
    }
    @media (min-width: 640px) { /* sm */
        .logo-img {
            width: {{ $logoSize['tabletWidth'] }}px !important;
        }
    }
    @media (min-width: 1024px) { /* lg */
        .logo-img {
            width: {{ $logoSize['desktopWidth'] }}px !important;
        }
    }
</style>

<!--Start Header Menu-->

<div id="header-container" x-data="{ open: false, openSubMenu: null, scrolled: false }"
     @scroll.window="scrolled = window.scrollY > 0"
     x-effect="document.body.classList.toggle('off-canvas-open', open)">

    <header :class="scrolled ? 'header-custom header-fixed' : 'header-custom'"
        class="top-0 left-1/2 -translate-x-1/2 w-full z-999 lg:p-0 sm:p-6 px-4 pt-2">

        <div class="lg:max-w-[1200px] mx-auto flex lg:pt-5 sm:pt-1 pt-1 justify-between gap-10">

            <!--Logo-->
            <div class="logo flex items-end">
                <a href="/">
                <img 
                    class="logo-img object-left h-auto mr-32 filter brightness-0 invert"
                    src="{{ $logo_url }}" 
                    alt="logo"
                >
                </a>
            </div>

            <div class="desktop-header flex flex-col justify-between w-full grow">

                <!--Above Header-->
                <div class="hidden lg:flex lg:flex-row lg:justify-end gap-5 mb-8 above-header">

                    <!--Button-->
                    @if(View::exists('components.dynamic.header-btn-hubungi'))
                        <x-sumimasen-cms::component-loader name="header-btn-hubungi" />
                    @endif
                    
                    @if(View::exists('components.dynamic.header-btn-brosur'))
                        <x-sumimasen-cms::component-loader name="header-btn-brosur" />
                    @endif
                   

                    <!--Translate-->
                    <x-partials.lang-switcher variant="desktop" />

                </div>

                <!--Main Menu-->
                @if ($menu && $menu->menuItems)
                    <x-partials.navigation-menu-header :menu="$menu" />
                @endif

            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex flex-col justify-center">
                <button 
                    @click="open = !open;"  
                    :class="scrolled ? 'text-[var(--color-black)]' : 'text-white'"
                    class="focus:outline-none cursor-pointer"
                >
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>


            <!-- Off-canvas Mobile Menu -->
            <div x-show="open" class="fixed inset-0 bg-black h-[100vh] bg-opacity-50 z-40 lg:hidden"
                @click="open = false"></div>

            <div x-show="open"
                class="fixed top-0 right-0 w-[90%] h-[100vh] bg-cover shadow-lg !z-90 transform transition-transform duration-300 ease-in-out lg:hidden"
                style="background-image: linear-gradient(90deg, rgba(255, 255, 255, 0.95) 10%, rgba(255, 255, 255, 0.45) 100%), url({{ Storage::url('media/about-image.jpg') }});"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">

                <div class="mobile-header px-6 mt-5 z-90">
                    <button @click="open = false" class="text-[var(--color-heading)] float-right cursor-pointer">
                        ✕
                    </button>

                    <div class="pt-10 overflow-y-auto max-h-[95vh] scrollbar-hide">

                        <!--Logo-->
                        <div class=" flex items-center ">
                            <a href="/"><img class="h-25" src="{{ $logo_url }}" alt="logo"></a>
                        </div>

                        @if ($menu && $menu->menuItems)
                            <x-partials.navigation-menu-header-mobile :menu="$menu" />
                        @endif

                        <!-- Button Off-Canvas-->
                        <div class="mt-10 flex flex-col gap-5">
                            @if(View::exists('components.dynamic.header-btn-hubungi'))
                                <x-sumimasen-cms::component-loader name="header-btn-hubungi" class="btn9 group w-fit" iconColor="black"/>
                            @endif
                            @if(View::exists('components.dynamic.header-btn-brosur'))
                                <x-sumimasen-cms::component-loader name="header-btn-brosur" class="btn9 group w-fit" iconColor="black"/>
                            @endif
                            
                        </div>

                        <!--Lang switcher mobile-->
                        <x-partials.lang-switcher variant="mobile" />

                    </div>
                </div>
            </div>

    </header>
</div>


<!--End Header Menu-->
