<div x-data="{showLogout:false}" class="inline-flex justify-between w-full top-0 left-0 right-0 border-b shadow pr-4">
    <button @click="showSide = ! showSide" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': showSide, 'inline-flex': ! showSide }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! showSide, 'inline-flex': showSide }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <form method="POST" action="{{ route('logout') }}" x-data class="my-auto ">
        @csrf
        <button wire:click="{{route('logout')}}" @click.prevent="$root.submit();" @mouseover="showLogout = true" @mouseleave="showLogout = false">
            <i x-show="showLogout" class="fa-solid fa-door-open"></i>
            <i x-show="!showLogout" class="fa-solid fa-right-from-bracket"></i>
        </button>
    </form>
</div>