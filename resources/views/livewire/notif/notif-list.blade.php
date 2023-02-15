<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    </h2>
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
                                            @if($notiv->type == 'user')
                                                <p>
                                                    from : 
                                                    {{$notiv->notif_user->first_name.' '.$notiv->notif_user->last_name}}
                                                    @if(isset($notiv->complain->post_id))
                                                    <button wire:click="openChat([{{$notiv->complain->user_id}},'user', {{$notiv->complain->id}}, 'complain'])" class="text-blue-400 hover:text-blue-600">
                                                        Hubungi
                                                    </button>
                                                    @endif
                                                </p>
                                            @else
                                                <p>from : {{$notiv->notif_employer->name}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <style>ul{margin-left:20px;}</style>
                                    @if($notiv->notif_type == 1)
                                        @if(isset($notiv->complain->post_id))
                                            <p>Produk : <a href="{{url('posts/'.$notiv->complain->post_id)}}" target="_self" class="text-blue-400 hover:text-blue-600 underline">{{$notiv->complain->post->title}}</a></p>
                                        @endif
                                        <p>Tipe Laporan : 
                                        @if(isset($notiv->complain->complain_list))
                                            {{$notiv->complain->complain_list->title}}
                                        @else
                                            Lainnya (produk salah diterima, perilaku penjual kurang baik, dll.)
                                        @endif
                                        </p>
                                    @else
                                        @if(isset($notiv->post))
                                            <p>Produk : {{$notiv->post->title}}</p>
                                        @endif
                                    @endif
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
                                        @if($notif->notif_type == 4)
                                            <div class="flex flex-row px-1 py-2">
                                                <div class="flex flex-row w-3/5">
                                                    @if($notif->read != 0)
                                                    <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2 -ml-2">
                                                    @endif
                                                    <h1 class="truncate">{{$notif->notif_user->first_name .' '. $notif->notif_user->last_name}} menambahkan anda kedalam relasinya.</h1>
                                                </div>
                                                <div class="flex flex-row ml-auto">
                                                    @if($notif->read != 0)
                                                    <button type="button" wire:click="follbackUser([{{$notif->id}},{{$notif->to}},{{$notif->from}},'{{$notif->type}}','{{$notif->type_to}}'])"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-1 mr-20 mb-2 dark:bg-blue-600 
                                                        dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Terima Permintaan
                                                    </button>
                                                    @else
                                                    <button type="button"
                                                        class="text-white bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-1 mr-20 my-auto dark:bg-blue-600 
                                                        dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-check mr-1"></i>
                                                        Terhubung
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex flex-row z-10 absolute top-1 right-0 pr-2 py-1" x-show="openFil" x-bind:class="style">
                                                <x-jet-delete-button id="{{$notif->id}}" wire:click="delete({{$notif->id}})" class="fa-solid hover:text-red-700 fa-trash-can mx-1 ml-1 px-1 py-1"></x-jet-delete-button>
                                                @if($notif->save == 0)
                                                <i class="fa-solid fa-star text-gray-200 mx-1 px-1 py-1"></i>
                                                @else
                                                <i wire:click="delsave({{$notif->id}})" class="fa-solid fa-star text-yellow-500 mx-1 px-1 py-1" onclick="autoremoveNotif()"></i>
                                                @endif
                                            </div>
                                            <hr>
                                        @else
                                            <button @click="$wire.clickOpen({{$notif->id}})" class="flex flex-row w-full px-1 py-2 focus:outline-none">
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
                                            </button>
                                            <div class="flex flex-row z-10 absolute top-1 right-0 pr-2 py-1" x-show="openFil" x-bind:class="style">
                                                <p>...  </p>
                                                <x-jet-delete-button id="{{$notif->id}}" wire:click="delete({{$notif->id}})" class="fa-solid hover:text-red-700 fa-trash-can mx-1 ml-1 px-1 py-1"></x-jet-delete-button>
                                                @if($notif->save == 0)
                                                <i wire:click="save({{$notif->id}})" class="fa-solid fa-star hover:text-yellow-500 mx-1 px-1 py-1" onclick="autoremoveNotif()"></i>
                                                @else
                                                <i wire:click="delsave({{$notif->id}})" class="fa-solid fa-star text-yellow-500 mx-1 px-1 py-1" onclick="autoremoveNotif()"></i>
                                                @endif
                                            </div>
                                            <hr>
                                        @endif
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