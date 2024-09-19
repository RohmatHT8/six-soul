<section>
    <nav class="px-5 md:px-10 py-2 flex justify-between items-center fixed top-0 z-50 right-0 left-0 bg-white">
        <div class="flex items-center">
            <img src="{{asset('images/logo.png')}}" alt="logo" class="w-14" />
            <p class="font-bold text-xl text-gray-800">SIX SOUL</p>
        </div>
        <div class="w-44 md:w-96 relative">
            <input wire:model.live="searchTerm" type="text" name="search" placeholder="search" id="search" class="block w-full rounded-full border-0 py-1.5 text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-400 sm:text-sm sm:leading-6 ps-9">
            <div class="absolute top-2 left-2">
                <svg class="w-5 h-5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </div>
        </div>
        <div class="w-10"></div>
    </nav>
    <div class="mb-10 lg:px-44 px-4 mt-20 relative" x-data="{ open: false }">
        @if(count($selected_categories) > 0 || $price_range || $nicotine_range)
        <div class="py-4">
            <div class="py-2 px-5 bg-lime-200 rounded-lg text-sm font-semibold text-gray-700">
                Filtered By
                @if(count($selected_categories) > 0)
                Category
                @endif
    
                @if($price_range)
                @if(count($selected_categories) > 0), @endif
                Price
                @endif
    
                @if($nicotine_range)
                @if(count($selected_categories) > 0 || $price_range), @endif
                Nicotine
                @endif
            </div>
        </div>
        @endif

        <!-- Button Filter -->
        <div @click="open = true">
            <svg class="w-6 h-6 fixed z-50 top-6 right-5 md:right-10 text-gray-400 hover:text-gray-500 cursor-pointer dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
            </svg>
        </div>

        <!-- Overlay -->
        <div class="bg-[rgba(0,0,0,0.5)] top-0 left-0 w-full h-full fixed z-50"
            x-show="open"
            @click.away="open = false"
            x-transition.opacity>

            <!-- Sidebar Filter -->
            <div class="bg-white w-94 h-full absolute right-0 p-5 overflow-x-auto transform transition-transform duration-700"
                :class="{ 'translate-x-full': !open, 'translate-x-0': open }"
                x-transition:enter="transform transition ease-in-out duration-700"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-700"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">

                <!-- Close Button -->
                <svg @click="open = false" class="w-6 h-6 text-gray-400 dark:text-white hover:text-red-400 cursor-pointer absolute right-3 top-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <!-- Filter Content -->
                <h2 class="text-2xl font-bold dark:text-gray-400">Categories</h2>
                <div class="w-16 pb-2 mb-6 border-b border-amber-600 dark:border-gray-400"></div>
                <ul>
                    @foreach ($categories as $category)
                    <li class="mb-4" wire:key="{{$category->id}}">
                        <label for="{{$category->slug}}" class="flex items-center dark:text-gray-400 ">
                            <input type="checkbox" wire:model.live="selected_categories" id="{{$category->slug}}" value="{{$category->id}}" class="w-4 h-4 mr-2">
                            <span class="text-lg">{{$category->name}}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>

                <h2 class="text-2xl font-bold dark:text-gray-400">Price Between</h2>
                <div class="w-16 pb-2 mb-6 border-b border-amber-600 dark:border-gray-400"></div>
                <div>
                    <div>{{Number::currency($price_range, 'IDR')}}</div>
                    <input type="range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer" max="{{$highest_price}}" value="0" step="50000">
                    <div class="flex justify-between ">
                        <span class="inline-block text-xs font-bold text-amber-600">{{Number::currency(10000, 'IDR')}}</span>
                        <span class="inline-block text-xs font-bold text-amber-600">-</span>
                        <span class="inline-block text-xs font-bold text-amber-600">{{Number::currency($highest_price, 'IDR')}}</span>
                    </div>
                </div>

                <h2 class="text-2xl font-bold dark:text-gray-400 mt-10">Nicotin Between</h2>
                <div class="w-16 pb-2 mb-6 border-b border-amber-600 dark:border-gray-400"></div>
                <div>
                    <div>{{$nicotine_range}}</div>
                    <input type="range" wire:model.live="nicotine_range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer" max="{{$highest_nicotine}}" value="0" step="1">
                    <div class="flex justify-between ">
                        <span class="inline-block text-xs font-bold text-amber-600">1</span>
                        <span class="inline-block text-xs font-bold text-amber-600">-</span>
                        <span class="inline-block text-xs font-bold text-amber-600">{{$highest_nicotine}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
        <div class="relative">
            <!-- <div wire:loading wire:target="searchTerm" class="absolute bg-white top-0 -right-2 -left-2 bottom-0 z-50">
                <div role="status" class="pt-20 mx-auto">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div> -->
            @if(count($products))
            <div wire:target="searchTerm" class="container mx-auto grid grid-cols-2 gap-2 lg:gap-6 md:grid-cols-3 lg:grid-cols-4 mb-5">

                @foreach ($products as $product)
                <div class="w-full mx-auto bg-white rounded-lg overflow-hidden shadow-md" wire:key="{{$product->id}}">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{url('uploads', $product->images[0])}}" alt="{{$product->slug}}">
                    </div>
                    <div class="w-full bg-gradient-to-r from-amber-500 to-lime-400 text-sm py-1 px-4 font-semibold rounded-ee-full text-white shadow-md">Ready</div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{$product->name}}</h2>
                        <p class="text-gray-600 text-sm opacity-65">{{$product->description}}</p>
                        @if($product->nicotine !== null)
                        <span class="px-3 text-xs font-bold text-white bg-amber-600 rounded-full">
                            Nicotine {{ $product->nicotine }}
                        </span>
                        @endif
                        <p class="text-gray-600 font-semibold">{{Number::currency($product->price, 'IDR')}}</p>
                        <div class="mt-4">
                            <a href="https://wa.me/6281219435587?text=Halo,%20saya%20tertarik%20dengan%20produk%20ini:%0A%0A*Nama Produk:*%20{{$product->name}}%0A*Deskripsi:*%20{{$product->description}}%0A*Nikotin:*%20{{$product->nicotine}}%0A*No SKU:*%20{{$product->no_sku}}%0A%0A{{url('uploads', $product->images[0])}}"
                                target="_blank"
                                class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded hover:bg-gray-700 transition duration-700">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="py-10 w-full">
                <h1 class="text-center font-semibold text-slate-600">No products match your search..</h1>
            </div>
            @endif
        </div>

        <div class="flex justify-end gap-5 mt-6">
            {{$products->links()}}
        </div>
    </div>
</section>