<div class="w-full" x-data="{showComment:false}">
<div wire:loading wire:target="likeIt,unLikeIt" class="fixed z-20 inset-0 place-content-center">
    <div class="fixed justify-center h-full w-full opacity-25 bg-slate-300"> </div>
        <div class="flex justify-center my-72">
            <div class="my-48 dots">
            </div>
        </div>
</div>
    <div class="flex flex-row w-full p-2">
        <!-- <i wire:click="@if(count($post->like) > 0) unLikeIt([{{$post->id}}]) @else likeIt([{{$post->id}}]) @endif" 
        class="@if(count($post->like) > 0) fa-solid @else fa-regular @endif fa-thumbs-up mx-1 my-auto cursor-pointer"></i>
        <p wire:click="@if(count($post->like) > 0) unLikeIt([{{$post->id}}]) @else likeIt([{{$post->id}}]) @endif" 
            class="mr-2 my-auto text-gray-500 text-sm cursor-pointer">
            @if(count($post->like) > 0)
                {{count($post->like)}} 
            @endif
            Suka
        </p> -->
        <div class="mb-4 flex flex-row py-2 pl-4 pr-4 rounded-lg shadow-lg border border-solid w-full">
            <input wire:model="komen" type="text" class="w-full h-12 focus:outline-none border-none" placeholder="Tulis Komentar">
            <i wire:click="sendComment([{{$post->id}}])" class="fa-solid fa-circle-chevron-right text-lg my-auto mx-auto cursor-pointer"></i>
        </div>
    </div> 
    @if($comments)
    <hr class="my-2">
    @foreach($comments as $comment)
    <div class="flex flex-row mt-4" x-data="{showComment{{$comment->id}}:false, commentChild{{$comment->id}}:false}">
        <div class="mr-2 w-16">
            @if($comment->author_type == 'user')
                @if($comment->author->profile_photo_url)
                <img src="{{url($comment->author->profile_photo_url)}}" alt="" class="w-14 h-14 rounded-full object-cover border border-solid">
                @else
                <img src="{{url('storage/photos/default-logo.jpg')}}" alt="" class="w-14 h-14 rounded-full object-cover border border-solid">
                @endif
            @endif
        </div>
        <div class="flex flex-col w-full">
            <div class="content border border-solid rounded shadow-lg p-2">
                <div class="flex flex-row">
                    @if($comment->author_type == 'user')
                    <p class="font-bold text-sm mr-1">{{$comment->author->name}}</p>
                    <!-- <p class="my-auto text-xs text-gray-500 italic">pengguna</p> -->
                    @endif
                </div>            
                <p class="text-gray-400 text-xs font-medium mb-2"> 
                    @php
                    $minutes = $thistime->diffInMinutes($comment->updated_at);
                    $hours = $thistime->diffInHours($comment->updated_at);
                    $days = $thistime->diff($comment->updated_at)->days;
                    $weeks = $thistime->diffInWeeks($comment->updated_at);
                    $months = $thistime->diffInMonths($comment->updated_at);
                    $years = $thistime->diffInYears($comment->updated_at);
                    @endphp
                    @if($minutes <= 60)
                        {{$minutes}} Menit yang lalu
                    @elseif($hours <= 24)
                        {{$hours}} Jam yang lalu
                    @elseif($days <= 7)
                        {{$days}} Hari yang lalu
                    @elseif($weeks <= 4)
                        {{$weeks}} Minggu yang lalu
                    @elseif($months <= 12)
                        {{$months}} Bulan yang lalu
                    @else
                        {{$years}} Tahun yang lalu
                    @endif
                </p>
                <div class="text-xs">
                    {!! $comment->comment !!}
                </div>
                <hr class="mt-2">
                <div class="flex flex-row p-2">
                    <div class="flex flex-row">
                        <i wire:click="@if($comment->my_like) unLikeIt([{{$post->id}}, {{$comment->id}}]) @else likeIt([{{$post->id}}, {{$comment->id}}]) @endif" 
                        class="@if($comment->my_like) fa-solid @else fa-regular @endif fa-thumbs-up text-sm mx-1 my-auto cursor-pointer"></i>
                        <p wire:click="@if($comment->my_like) unLikeIt([{{$post->id}}, {{$comment->id}}]) @else likeIt([{{$post->id}}, {{$comment->id}}]) @endif" 
                            class="mr-2 my-auto text-gray-500 text-xs cursor-pointer">
                            @if(count($comment->like) > 0)
                                {{count($comment->like)}} 
                            @endif
                            Suka
                        </p>
                    </div>
                    <div class="flex flex-row">
                        <i class="fa-regular fa-comment-dots mx-1 my-auto text-sm cursor-pointer" @click="showComment{{$comment->id}} =! showComment{{$comment->id}}"></i>
                        <p class="mr-2 my-auto text-gray-500 cursor-pointer text-xs" @click="showComment{{$comment->id}} =! showComment{{$comment->id}}">Balas</p>
                    </div>
                    <div class="flex flex-row">
                        @if(count($comment->child) != null)
                            <template x-if="commentChild{{$comment->id}}">
                                <i class="fa-sharp fa-solid fa-caret-up text-sm mx-1 my-auto cursor-pointer" @click="commentChild{{$comment->id}} =! commentChild{{$comment->id}}"></i>
                            </template>
                            <template x-if="!commentChild{{$comment->id}}">
                                <i class="fa-sharp fa-solid fa-caret-down text-sm mx-1 my-auto cursor-pointer" @click="commentChild{{$comment->id}} =! commentChild{{$comment->id}}"></i>
                            </template>
                            <p class="mr-1 my-auto text-gray-500 cursor-pointer text-xs" 
                                @click="commentChild{{$comment->id}} =! commentChild{{$comment->id}}">
                                @if(count($comment->child) != null)
                                    {{count($comment->child)}}
                                @endif
                                Balasan
                            </p>
                        @endif
                    </div>
                </div>
                <div class="mb-4 flex flex-row py-2 pl-4 pr-6 rounded-3xl shadow border border-solid" x-show="showComment{{$comment->id}}">
                    <input wire:model="komen" type="text" class="w-full focus:outline-none border-none" placeholder="Tambah Komentar">
                    <i wire:click="sendComment([{{$post->id}},{{$comment->id}}])" class="fa-solid fa-circle-chevron-right text-lg my-auto cursor-pointer"></i>
                </div>
            </div>
            @if(count($comment->childs) != null)
                <div x-show="commentChild{{$comment->id}}">
                    @foreach($comment->child as $child)
                        <div class="flex flex-row mt-4" x-data="{showComment{{$child->id}}:false}">
                            <div class="mr-2 min-w-20">
                            @if($child->author_type == 'user')
                                @if($child->author->profile_photo_url)
                                <img src="{{url($child->author->profile_photo_url)}}" alt="" class="w-14 rounded-3xl border border-solid">
                                @else
                                <img src="{{url('storage/photos/default-logo.jpg')}}" alt="" class="w-14 rounded-3xl border border-solid">
                                @endif
                            @endif
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="content border border-solid rounded shadow-lg p-2">
                                    <div class="flex flex-row">
                                        @if($child->author_type == 'user')
                                        <p class="font-bold text-sm mr-0.5 sm:mr-1 truncate">{{$child->author->name}}</p>
                                        <!-- <p class="my-auto text-xs text-gray-500 italic hidden sm:flex">pengguna</p> -->
                                        @endif
                                        <i class="fa-solid fa-caret-right mx-2 my-auto text-xs"></i>
                                        @php
                                            if($child->parent2_id):
                                                $isparent = 'parent2';
                                                $parent_id = $child->parent2_id;
                                            else:
                                                $isparent = 'parent';
                                                $parent_id = $child->parent_id;
                                            endif;
                                            $parent_type = $child->$isparent->author_type;
                                        @endphp
                                        @if($parent_type == 'user')
                                        <p class="font-bold text-sm mr-0.5 sm:ml-1 truncate">{{$child->$isparent->author->name}}</p>
                                        @endif
                                    </div>    
                                    <p class="text-gray-400 text-xs font-medium mb-2"> 
                                        @php
                                        $minutes = $thistime->diffInMinutes($child->updated_at);
                                        $hours = $thistime->diffInHours($child->updated_at);
                                        $days = $thistime->diff($child->updated_at)->days;
                                        $weeks = $thistime->diffInWeeks($child->updated_at);
                                        $months = $thistime->diffInMonths($child->updated_at);
                                        $years = $thistime->diffInYears($child->updated_at);
                                        @endphp
                                        @if($minutes <= 60)
                                            {{$minutes}} Menit yang lalu
                                        @elseif($hours <= 24)
                                            {{$hours}} Jam yang lalu
                                        @elseif($days <= 7)
                                            {{$days}} Hari yang lalu
                                        @elseif($weeks <= 4)
                                            {{$weeks}} Minggu yang lalu
                                        @elseif($months <= 12)
                                            {{$months}} Bulan yang lalu
                                        @else
                                            {{$years}} Tahun yang lalu
                                        @endif
                                    </p>
                                    <div class="text-xs">
                                        {!! $child->comment !!}
                                    </div>
                                    <hr class="my-2">
                                    <div class="flex flex-row p-2">
                                        <i wire:click="@if($child->my_like) unLikeIt([{{$post->id}}, {{$child->id}}]) @else likeIt([{{$post->id}}, {{$child->id}}]) @endif" 
                                        class="@if($child->my_like) fa-solid @else fa-regular @endif fa-thumbs-up text-sm mx-1 my-auto cursor-pointer"></i>
                                        <p wire:click="@if($child->my_like) unLikeIt([{{$post->id}}, {{$child->id}}]) @else likeIt([{{$post->id}}, {{$child->id}}]) @endif" 
                                            class="mr-2 my-auto text-gray-500 text-xs cursor-pointer">
                                            @if(count($child->like) > 0)
                                                {{count($child->like)}} 
                                            @endif
                                            Suka
                                        </p>
                                        <i class="fa-regular fa-comment-dots text-sm mx-1 my-auto cursor-pointer" @click="showComment{{$child->id}} =! showComment{{$child->id}}"></i>
                                        <p class="mr-2 my-auto text-gray-500 cursor-pointer text-xs" @click="showComment{{$child->id}} =! showComment{{$child->id}}">Balas  </p>
                                    </div>
                                    <div class="mb-4 flex flex-row py-2 pl-2 pr-4 rounded-3xl shadow border border-solid" x-show="showComment{{$child->id}}">
                                        <input wire:model="komen" type="text" class="w-full focus:outline-none text-xs border-none" placeholder="Tambah Komentar">
                                        <i wire:click="sendComment([{{$post->id}}, {{$comment->id}}, {{$child->id}}])" class="fa-solid fa-circle-chevron-right text-lg my-auto cursor-pointer"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endforeach
    @endif
</div>
