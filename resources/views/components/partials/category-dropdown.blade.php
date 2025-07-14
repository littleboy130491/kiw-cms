@php
    use App\Models\Category;
    $categories = Category::orderBy('title')->get();
@endphp

<div class="relative max-w-md w-full" x-data="{
    open: false,
    selected: 'Pilih Kategori',
    categories: @js(
    $categories->map(function ($category) {
        return [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'url' => route('cms.taxonomy.archive', [app()->getLocale(), config('cms.content_models.categories.slug') ?? 'categories', $category->slug]),
        ];
    }),
)
}" @click.away="open = false">

    <input type="text" placeholder="Pilih Kategori"
        class="w-full pl-3 pr-4 py-2 border border-[var(--color-border)] rounded-md focus:outline-none focus:ring-2 focus:var(--color-blue) cursor-pointer"
        x-model="selected" @click="open = !open" readonly />

    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <img src="{{ Storage::url('media/chevron-down-solid.png') }}" alt="" :class="{ 'rotate-180': open }"
            class="transition-transform duration-200">
    </div>

    <!-- Dropdown -->
    <ul x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white border border-gray-300 shadow-lg">

        <!-- All Categories Option -->
        <li>
            <a href="{{ route('cms.archive.content', [app()->getLocale(), config('cms.content_models.posts.slug') ?? 'posts']) }}"
                class="block px-4 py-2 hover:bg-[var(--color-blue)] hover:text-white transition-colors duration-150"
                @click="selected = 'Semua Kategori'; open = false">
                Semua Kategori
            </a>
        </li>

        <!-- Dynamic Categories -->
        <template x-for="category in categories" :key="category.id">
            <li>
                <a :href="category.url"
                    class="block px-4 py-2 hover:bg-[var(--color-blue)] hover:text-white transition-colors duration-150"
                    @click="selected = category.title; open = false" x-text="category.title"></a>
            </li>
        </template>
    </ul>
</div>
