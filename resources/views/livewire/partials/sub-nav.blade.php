<div class="fixed z-40 right-0 left-0 bg-white top-16">
    <div class="relative w-full h-14 lg:w-[70vw] lg:mx-auto">
        <!-- Panah Kiri -->
        <button id="scrollLeft" class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white p-2 rounded-full opacity-50 hover:opacity-100 z-auto">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
            </svg>
        </button>

        <!-- Konten yang di-scroll -->
        <div id="scrollContainer" class="py-3 px-5 flex lg:justify-center gap-3 overflow-x-auto overflow-y-hidden h-14 whitespace-nowrap scroll-smooth">
            <p class="bg-gray-950 text-white cursor-pointer rounded-xl px-2 py-1">All</p>
            @foreach ($categories as $category)
            <p class="bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-xl px-2 py-1 text-gray-800"
                wire:key="{{ $category->id }}"
                wire:model.live="selected_categories"
                id="{{$category->slug}}"
                value="{{$category->id}}">
                {{ $category->name }}
            </p>
            @endforeach
        </div>

        <!-- Panah Kanan -->
        <button id="scrollRight" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white p-2 rounded-full opacity-50 hover:opacity-100">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
            </svg>
        </button>
    </div>
</div>