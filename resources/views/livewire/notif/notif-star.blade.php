<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <livewire:profil-nav/>
    </h2>
</x-slot>

<x-slot name="footer">
</x-slot>
    <div class="h-screen bglg">    
        <div class="flex max-w-7xl h-screen mx-auto py-0 sm:py-10 sm:px-6 lg:px-8">
            <!-- <div class="w-1/5">
                <h3 class="text-lg font-medium text-gray-900">Notifikasi Berbintang</h3>
            </div> -->

            <div class="w-full shadow overflow-hidden sm:rounded-md" style="background-color: #ffffffa6;">
                <div class="">
                    <div class="px-4 py-5 sm:p-6 h-screen" style="background-color: #ffffff80;">
                        <div class="grid grid-cols-6 gap-6 h-screen">
                            <div class="col-span-10 sm:col-span-6 h-screen">
                                    <div class="flex flex-row border-b pb-6">
                                        <div class="hidden sm:flex mr-1">
                                            <x-jet-nav-link href="{{ route('notif') }}" :active="request()->routeIs('notif')" class="text-lg">
                                                {{ __('Notifikasi') }}
                                            </x-jet-nav-link>
                                        </div>
                                        <div class="hidden sm:flex ml-1">
                                            <x-jet-nav-link href="{{ route('notif.star') }}" :active="request()->routeIs('notif.star')" class="text-lg">
                                                {{ __('Notifikasi Berbintang') }}
                                            </x-jet-nav-link>
                                        </div>
                                    </div>
                                @if($isOpen)
                                <div class="overflow-auto hntf pt-2">
                                    <div class="flex flex-row">
                                        <!-- <img src="#" alt=""> -->
                                        <div class="mb-4">
                                            <h1 class="text-xl font-semibold">{{$notiv->title}}</h1>
                                            <p>from : {{$notiv->notif_employer->name}}</p>
                                        </div>
                                    </div>
                                    <style>ul{margin-left:20px;}</style>
                                    <h1>Deskripsi :</h1>
                                    <p>{!! $notiv->desc !!}</p>
                                @else
                                    @if (session()->has('message'))
                                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                                        <div class="flex">
                                            <div>
                                            <p class="text-sm">{{ session('message') }}</p>
                                            </div>
                                        </div>
                                        </div>
                                    @endif
                                    @foreach($notifs as $notif)
                                    <div class="relative cursor-pointer hover:bg-gray-300"
                                    x-data="{openFil:false,style:'bg-white'}" x-on:mouseenter="style='bg-gray-300';openFil=true" x-on:mouseleave="style='bg-white';openFil=false">
                                        <div wire:click="clickOpen({{$notif->id}})" class="flex flex-row px-1 py-2">
                                            <div class="flex flex-row w-1/4">
                                                @if($notif->read != 0)
                                                <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2 -ml-2">
                                                @endif
                                                <h1 class="truncate">{{$notif->title}}</h1>
                                            </div>
                                            <p class="pr-2 text-gray-400">|</p>
                                            <div class="flex flex-row w-3/4">
                                                <div class="truncate">{!! strip_tags($notif->desc) !!}</div>
                                            </div>
                                        </div>
                                        <div class="flex flex-row z-10 absolute top-1 right-0 pr-2 py-1" x-show="openFil" x-bind:class="style">
                                            <p>...  </p>
                                            <x-jet-delete-button id="{{$notif->id}}" wire:click="delete({{$notif->id}})" class="fa-solid hover:text-red-700 fa-trash-can mx-1 ml-1 px-1 py-1"></x-jet-delete-button>
                                            @if($notif->save == 0)
                                            <i wire:click="save({{$notif->id}})" class="fa-solid fa-star hover:text-yellow-500 mx-1 px-1 py-1"></i>
                                            @else
                                            <i wire:click="delsave({{$notif->id}})" class="fa-solid fa-star text-yellow-500 mx-1 px-1 py-1"></i>
                                            @endif
                                        </div>
                                        <hr>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                <div class="flex items-center justify-end px-4 py-5 bg-gray-50 text-right sm:px-6 border-t mt-2" style="background-color: #ffffff80;">
                                    @if($isOpen)
                                        <x-jet-button wire:click="clickClose">
                                            {{ __('Back') }}
                                        </x-jet-button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
