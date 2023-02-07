<div class="relative mt-2 mx-auto w-60 sm:w-80 mb-1" x-data="{searchmodal:false}">
    <div class="absolute right-0 flex z-50 items-center mr-3 mt-2">
    <lord-icon
    	src="https://cdn.lordicon.com/msoeawqm.json"
		trigger="loop"
		colors="primary:#1b1091,secondary:#1663c7"
		style="width:30px;height:30px">
	</lord-icon>
    </div>
    <input id="searchbox" autocomplete="off" wire:model="search_bar" x-on:keydown="searchmodal = true" x-on:keydown.enter="getUrl()" type="text" class="pl-3 pr-4 mt-1 h-10 w-full rounded-full shadow-md border focus:border-gray-100 focus:bg-white focus:ring-0 text-sm" placeholder="Cari Berita">
    <div x-show="searchmodal" class="fixed modal z-10 bg-white rounded rounded-b h-48 sm:h-72 overflow-auto zind70" x-on:click.away="searchmodal = false" @scroll.window.throttle="searchmodal = false">
        <div class="flex flex-col bg-white px-1 w-60 sm:w-80 text-center text-sm">
            <div class="flex flex-col mt-2 text-left">
                @if($search_news)
                    <!-- Loker -->
                    @foreach($search_news as $search_data)
                    <div onclick="window.open(`{{url('/posts/'.$search_data->id)}}`, '_self')" class="flex flex-row px-1 py-2 border-b border-solid border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <div class="mr-2 w-1/4">
                            @if(count($search_data->images) > 0)
                                @foreach($search_data->images as $images)
                                    @if($loop->first)
                                        <img src="{{url($images->url)}}" alt="" class="w-10 h-10 m-auto rounded-3xl border border-solid object-contain">
                                    @endif
                                @endforeach
                            @else
                            <div class="w-10 h-10 m-auto px-3 py-2 rounded-3xl border border-solid">
                                <i class="fa-solid fa-magnifying-glass my-auto text-center"></i>
                            </div>
                            @endif
                        </div>
                        <div class="my-auto w-3/4">
                            <p>{{$search_data->title}}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="flex flex-row px-1 py-2 my-4 border-gray-200 hover:bg-gray-200 cursor-pointer" onclick="getUrl()">
                        <p class="mx-auto my-auto text-blue-700">Lihat Semua</p>
                    </div>
                @else
                    <p>Data tidak ditemukan!</p>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function getUrl(){
        // alert($('#searchbox').val());
        if(`{{request()->routeIs('cari')}}`){
            window.livewire.emit('searchData', $('#searchbox').val());
        }else{
            window.open(`{{url('cari')}}/`+$('#searchbox').val(), '_self');
        }

    }
</script>