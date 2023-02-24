<x-slot name="admin">
</x-slot>
<x-slot name="header">
    <p class="w-1/2 mx-0.5 text-left font-bold text-base sm:text-lg">Edit Notifications</p>
    <p class="w-full m-0.5 text-right">
        <a href="{{route('admin.dashboard')}}" class="hover:text-cyan-500 hover:underline">Admin</a>
        /
        <a href="{{route('admin.notif.notif')}}" class="hover:text-cyan-500 hover:underline">Notifications</a>
    </p>
</x-slot>
<x-slot name="footer">
</x-slot>
    <div class="h-screen bglg">    
        <div class="flex max-w-7xl h-screen mx-auto py-0 sm:py-10 sm:px-6 lg:px-8">
            <!-- <div class="w-1/5">
                <h3 class="text-lg font-medium text-gray-900">Notifikasi</h3>
            </div> -->

<div wire:loading class="fixed z-20 inset-0 place-content-center ">
    <div class="fixed justify-center h-full w-full opacity-25 bg-slate-300"> </div>
        <div class="flex justify-center my-72">
            <div class="my-48 dots">
            </div>
        </div>
</div> 

            <div class="w-full shadow overflow-hidden sm:rounded-md" style="background-color: #ffffffa6;">
                <div class="">
                    <div class="px-4 py-5 sm:p-6 h-screen" style="background-color: #ffffff80;">
                        <div class="grid grid-cols-6 gap-6 h-screen">
                            <div class="col-span-10 sm:col-span-6 h-screen">
                                <div class="flex flex-row border-b pb-6">
                                    <div wire:click="selectNotif(0)" class="flex mr-1 text-lg @if(!$star) border-b-2 border-solid border-blue-500 @endif cursor-pointer">
                                            {{ __('Notifikasi') }}
                                    </div>
                                    <div wire:click="selectNotif(1)" class="flex ml-1 text-lg @if($star) border-b-2 border-solid border-blue-500 @endif cursor-pointer">
                                            {{ __('Notifikasi Berbintang') }}
                                    </div>
                                </div>
                                @if (session()->has('message'))
                                    <div class="alert-success bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                                    <div class="flex">
                                        <div>
                                        <p class="text-sm">{{ session('message') }}</p>
                                        </div>
                                    </div>
                                    </div>
                                @endif
                                @if($isOpen)
                                <div class="overflow-auto hntf pt-2">
                                    <div class="flex flex-row">
                                        <!-- <img src="#" alt=""> -->
                                        <div class="mb-4">
                                            <h1 class="text-xl font-semibold">{{$notiv->title}}</h1>
                                        </div>
                                    </div>
                                    <style>ul{margin-left:20px;}</style>
                                    @if(isset($notiv->post))
                                        <p>Judul Berita :<a href="{{url('posts/'.$notiv->post->id)}}" class="text-blue-500"> {{$notiv->post->title}}</a></p>
                                    @endif
                                    <div class="inline-flex">
                                    <h1>Dikirim oleh :</h1>
                                    <p class="pl-2">{{ $notiv->userFrom->name }}</p>
                                    </div>
                                    <h1>Deskripsi :</h1>
                                    <p>{!! $notiv->desc !!}</p>
                                @else
                                    @foreach($notifs as $notif)
                                        @if($agent->isMobile())
                                        <div class="relative cursor-pointer"
                                        x-data="{openFil:true,style:'bg-white'}">
                                        @else
                                        <div class="relative cursor-pointer hover:bg-gray-300"
                                        x-data="{openFil:false,style:'bg-white'}" x-on:mouseenter="style='bg-gray-300';openFil=true" x-on:mouseleave="style='bg-white';openFil=false">
                                        @endif
                                            <button @click="$wire.clickOpen({{$notif->id}})" class="flex flex-row w-full px-1 py-2 focus:outline-none">
                                                <div class="flex flex-row w-1/4">
                                                    @if($notif->read != 0 ||($notif->to == 0 && count($notif->read_it) != 1))
                                                    <span class="flex absolute h-2 w-2 top-1 left-0 -mt-1 -mr-1 pointer-events-none">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
                                                    </span>
                                                    @endif
                                                    <h1 class="truncate">{{$notif->title}}</h1>
                                                </div>
                                                <p class="pr-2 text-gray-400">|</p>
                                                <div class="flex flex-row w-3/4">
                                                    <div class="truncate">{!! strip_tags($notif->desc) !!}</div>
                                                </div>
                                            </button>
                                            @if($notif->to != null)
                                            <div class="flex flex-row z-10 absolute top-1 right-0 pr-2 py-1" x-show="openFil" x-bind:class="style">
                                                <p>...  </p>
                                                <x-jet-delete-button id="{{$notif->id}}" wire:click="delete({{$notif->id}})" class="fa-solid hover:text-red-700 fa-trash-can mx-1 ml-1 px-1 py-1"></x-jet-delete-button>
                                                @if($notif->save == 0)
                                                <i wire:click="save({{$notif->id}})" class="fa-solid fa-star hover:text-yellow-500 mx-1 px-1 py-1" onclick="autoremoveNotif()"></i>
                                                @else
                                                <i wire:click="delsave({{$notif->id}})" class="fa-solid fa-star text-yellow-500 mx-1 px-1 py-1" onclick="autoremoveNotif()"></i>
                                                @endif
                                            </div>
                                            @endif
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                                <div class="flex items-center justify-end px-4 py-5 bg-gray-50 text-right sm:px-6 border-t mt-2" style="background-color: #ffffff80;">
                                    @if($isOpen)
                                        <button type="button" onclick="autoremoveNotif()" wire:click="clickClose"
                                        class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                            {{ __('Back') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>