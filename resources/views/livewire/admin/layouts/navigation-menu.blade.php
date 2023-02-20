<div x-data="{showLogout:false}" class="inline-flex justify-between w-full top-0 left-0 right-0 border-b shadow pr-4">
    <button @click="showSide = ! showSide" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': showSide, 'inline-flex': ! showSide }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! showSide, 'inline-flex': showSide }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="flex flex-row gap-4">
        <div class="py-2">
            <span class="relative inline-flex rounded-md">
                <button type="button" class="inline-flex items-center px-1 text-base leading-6 font-medium rounded-md text-gray-800 bg-white hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                <i class="fa-solid fa-envelope text-sm sm:text-lg my-auto mx-auto"></i>
                </button>
                <span class="flex absolute h-2 w-2 top-0 right-0 -mt-1 -mr-1 pointer-events-none">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
                </span>
            </span>
        </div>
        <form method="POST" action="{{ route('logout') }}" x-data class="my-auto ">
            @csrf
            <button wire:click="{{route('logout')}}" @click.prevent="$root.submit();" @mouseover="showLogout = true" @mouseleave="showLogout = false">
                <i x-show="showLogout" class="fa-solid fa-door-open"></i>
                <i x-show="!showLogout" class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </div>
</div>