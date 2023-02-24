@if($agent->isMobile())
<div  x-show="showSide" @click.outside="showSide = false" x-transition:enter-start="opacity-0 transform scale-x-0 -translate-x-1/2" x-transition:enter-end="opacity-100 transform scale-x-100 translate-x-0" x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="opacity-100 transform scale-x-100 translate-x-0" x-transition:leave-end="opacity-0 transform scale-x-0 -translate-x-1/2" 
    class="fixed w-1/2 px-2 py-2 min-h-screen bg-gray-800 text-white z-20">
@else
<div  x-show="showSide" x-transition:enter-start="opacity-0 transform scale-x-0 -translate-x-1/2" x-transition:enter-end="opacity-100 transform scale-x-100 translate-x-0" x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="opacity-100 transform scale-x-100 translate-x-0" x-transition:leave-end="opacity-0 transform scale-x-0 -translate-x-1/2" 
    class="w-1/4 py-1 min-h-screen bg-gray-800 z-20">
@endif
    <a href="{{ route('admin.dashboard') }}"
        class="flex flex-row px-2 py-3 mx-auto text-gray-300 hover:text-gray-400 border-b border-solid border-gray-700 cursor-pointer">
        <x-jet-application-mark class="block h-9 w-auto mx-0.5 my-auto bg-gray-300 rounded-full" />
        <p class="text-sm sm:text-2xl font-bold mx-2 my-auto">{{__('Bangkit Indonesiaku')}}</p>
    </a>
    <a href="{{ route('admin.profile.show') }}"
        class="flex flex-row mx-2 py-3 text-gray-300 hover:text-gray-400 border-b border-solid border-gray-700 cursor-pointer">
        <img src="{{url(Auth::user()->profile_photo_url)}}" alt="poto-user" class="block bg-gray-300 rounded-full h-7 w-7 w-auto mx-0.5 my-auto" />
        <p class="text-sm sm:text-base font-semibold mx-0.5 my-auto">{{Auth::user()->name}}</p>
    </a>
    <div class="mt-3 px-1">
        <x-jet-side-link @click="openProfilePT = !openProfilePT" :active="request()->routeIs('admin.profilept.*')" class="mt-2 mb-1 h-14">
            <i class="fa-solid fa-address-card text-sm sm:text-xl my-auto mx-2"></i>
            <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Profil Perusahaan')}}</p>
        </x-jet-side-link>
        <div class="flex flex-col ml-2 mb-2" x-show="openProfilePT">
            <x-jet-side-link tags="child" href="{{ route('admin.profilept.aboutus') }}" :active="request()->routeIs('admin.profilept.aboutus')" class="my-0.5 h-10">
                <i class="fa-solid fa-circle-info text-sm sm:text-xl my-auto mx-2"></i>
                <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Tentang Kami')}}</p>
            </x-jet-side-link>
            <x-jet-side-link tags="child" href="{{ route('admin.profilept.vimi') }}" :active="request()->routeIs('admin.profilept.vimi')" class="my-0.5 h-10">
                <i class="fa-solid fa-compass-drafting text-sm sm:text-xl my-auto mx-2"></i>
                <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Visi & Misi')}}</p>
            </x-jet-side-link>
        </div>
        <x-jet-side-link href="{{ route('admin.posts') }}" :active="request()->routeIs('admin.posts')" class="my-2 h-14">
            <i class="fa-solid fa-newspaper text-sm sm:text-base my-auto mx-2"></i>
            <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Posts')}}</p>
        </x-jet-side-link>
        <x-jet-side-link @click="openFilter = !openFilter" :active="request()->routeIs('admin.filter.*')" class="mt-2 mb-1 h-14">
            <i class="fa-solid fa-filter text-sm sm:text-xl my-auto mx-2"></i>
            <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Filters')}}</p>
        </x-jet-side-link>
        <div class="flex flex-col ml-2 mb-2" x-show="openFilter">
            <x-jet-side-link tags="child" href="{{ route('admin.filter.categories') }}" :active="request()->routeIs('admin.filter.categories')" class="my-0.5 h-10">
                <i class="fa-solid fa-quote-left text-sm sm:text-xl my-auto mx-2"></i>
                <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Categories')}}</p>
            </x-jet-side-link>
            <x-jet-side-link tags="child" href="{{ route('admin.filter.tags') }}" :active="request()->routeIs('admin.filter.tags')" class="my-0.5 h-10">
                <i class="fa-solid fa-tag text-sm sm:text-xl my-auto mx-2"></i>
                <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Tags')}}</p>
            </x-jet-side-link>
        </div>
        <x-jet-side-link @click="openNotif = !openNotif" :active="request()->routeIs('admin.notif.*')" class="mt-2 mb-1 h-14">
            <i class="fa-solid fa-envelopes-bulk text-sm sm:text-xl my-auto mx-2"></i>
            <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Notifications')}}</p>
        </x-jet-side-link>
        <div class="flex flex-col ml-2 mb-2" x-show="openNotif">
            <x-jet-side-link tags="child" href="{{ route('admin.notif.notif') }}" :active="request()->routeIs('admin.notif.notif')" class="my-0.5 h-10">
                <i class="fa-solid fa-envelope text-sm sm:text-xl my-auto mx-2"></i>
                <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Notification')}}</p>
            </x-jet-side-link>
            <x-jet-side-link tags="child" href="{{ route('admin.notif.templates') }}" :active="request()->routeIs('admin.notif.templates')" class="my-0.5 h-10">
                <i class="fa-solid fa-file text-sm sm:text-xl my-auto mx-2"></i>
                <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Template Notif')}}</p>
            </x-jet-side-link>
        </div>
        <x-jet-side-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')" class="my-2 h-14">
            <i class="fa-solid fa-users text-sm sm:text-xl my-auto mx-2"></i>
            <p class="text-sm sm:text-base mx-0.5 my-auto">{{__('Users')}}</p>
        </x-jet-side-link>
    </div>
</div>
<div x-show="!showSide" x-transition:enter.delay.300ms
    class="py-2 bg-gray-800 text-gray-300">
    <a href="{{ route('admin.dashboard') }}"
        class="flex flex-row px-2 py-3 justify-center text-gray-300 hover:text-gray-400 border-b border-solid border-gray-700 cursor-pointer">
        <x-jet-application-mark class="block h-9 w-auto mx-0.5 my-auto bg-gray-300 rounded-full" />
    </a>
    <a href="{{ route('admin.profile.show') }}"
        class="flex flex-row mx-2 py-3 justify-center text-gray-300 hover:text-gray-400 border-b border-solid border-gray-700 cursor-pointer">
        <img src="{{url(Auth::user()->profile_photo_url)}}" alt="poto-user" class="block bg-gray-300 rounded-full h-7 w-7 object-cover mx-auto my-auto" />
    </a>
    <div class="mt-3 px-1">
        <x-jet-side-link @click="openProfilePT = !openProfilePT" :active="request()->routeIs('admin.profilept.*')" class="mt-2 mb-1 h-14">
            <i class="fa-solid fa-address-card text-sm sm:text-xl my-auto mx-auto"></i>
        </x-jet-side-link>
        <div class="flex flex-col ml-1 mb-2" x-show="openProfilePT">
            <x-jet-side-link tags="child" href="{{ route('admin.profilept.aboutus') }}" :active="request()->routeIs('admin.profilept.aboutus')" class="my-0.5 h-10">
                <i class="fa-solid fa-circle-info text-sm sm:text-xl my-auto mx-auto"></i>
            </x-jet-side-link>
            <x-jet-side-link tags="child" href="{{ route('admin.profilept.vimi') }}" :active="request()->routeIs('admin.profilept.vimi')" class="my-0.5 h-10">
                <i class="fa-solid fa-compass-drafting text-sm sm:text-xl my-auto mx-auto"></i>
            </x-jet-side-link>
        </div>
        <x-jet-side-link href="{{ route('admin.posts') }}" :active="request()->routeIs('admin.posts')" class="my-2 h-14">
            <i class="fa-solid fa-newspaper text-sm sm:text-base my-auto mx-auto"></i>
        </x-jet-side-link>
        <x-jet-side-link @click="openFilter = !openFilter" :active="request()->routeIs('admin.filter.*')" class="mt-2 mb-1 h-14">
            <i class="fa-solid fa-filter text-sm sm:text-xl my-auto mx-auto"></i>
        </x-jet-side-link>
        <div class="flex flex-col ml-1 mb-2" x-show="openFilter">
            <x-jet-side-link tags="child" href="{{ route('admin.filter.categories') }}" :active="request()->routeIs('admin.filter.categories')" class="my-0.5 h-10">
                <i class="fa-solid fa-quote-left text-sm sm:text-xl my-auto mx-auto"></i>
            </x-jet-side-link>
            <x-jet-side-link tags="child" href="{{ route('admin.filter.tags') }}" :active="request()->routeIs('admin.filter.tags')" class="my-0.5 h-10">
                <i class="fa-solid fa-tag text-sm sm:text-xl my-auto mx-auto"></i>
            </x-jet-side-link>
        </div>
        <x-jet-side-link @click="openNotif = !openNotif" :active="request()->routeIs('admin.notif.*')" class="mt-2 mb-1 h-14">
            <i class="fa-solid fa-envelopes-bulk text-sm sm:text-xl my-auto mx-auto"></i>
        </x-jet-side-link>
        <div class="flex flex-col ml-1 mb-2" x-show="openNotif">
            <x-jet-side-link tags="child" href="{{ route('admin.notif.notif') }}" :active="request()->routeIs('admin.notif.notif')" class="my-0.5 h-10">
                <i class="fa-solid fa-envelope text-sm sm:text-xl my-auto mx-auto"></i>
            </x-jet-side-link>
            <x-jet-side-link tags="child" href="{{ route('admin.notif.templates') }}" :active="request()->routeIs('admin.notif.templates')" class="my-0.5 h-10">
                <i class="fa-solid fa-file text-sm sm:text-xl my-auto mx-auto"></i>
            </x-jet-side-link>
        </div>
        <x-jet-side-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')" class="my-2 h-14">
            <i class="fa-solid fa-users text-sm sm:text-xl my-auto mx-auto"></i>
        </x-jet-side-link>
    </div>
</div>
