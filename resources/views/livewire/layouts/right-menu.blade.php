@if($populers)
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b border-solid bg-blue-500 text-sm sm:text-lg text-white text-center">Terpopuler</p>
        @foreach($populers as $key => $populer)
        <div class="flex flex-row">
            <div class="bg-blue-500 text-white">
                <p class="my-auto mx-auto align-middle text-lg sm:text-xl font-bold">{{$key+1}}</p>
            </div>
            <p class="py-1 px-1 my-auto line-clamp-2 text-xs sm:text-base">{{$populer->title}}</p>
        </div>
        <hr>
        @endforeach
    </div>
@endif
@if($comments)
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b-4 border-solid border-b-blue-500  text-sm sm:text-lg text-center">Komentar Terhangat</p>
        @foreach($comments as $comment)
        <div class="flex flex-row py-1 px-1">
            @if($comment->author->profile_photo_url)
            <img src="{{url($comment->author->profile_photo_url)}}" alt="" class="my-auto w-10 sm:w-14 h-10 sm:h-14 rounded-3xl border border-solid">
            @else
            <img src="#" alt="" class="my-auto w-14 h-14 rounded-3xl border border-solid">
            @endif
            <div class="px-1">
                <p class="font-bold truncate text-sm sm:text-base">{{$comment->author->name}}</p>
                <p class="line-clamp-1 sm:line-clamp-2 text-xs sm:text-sm">{{$comment->comment}}</p>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
@endif
@if(count($choices) > 0)
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b border-solid bg-blue-500 text-sm sm:text-lg text-white text-center">Berita Pilihan</p>
        @foreach($choices as $choice)
        <div class="flex flex-row py-1 px-1">
            @if($choice->images)
            @foreach($choice->images as $img)
            @if($loop->first)
            <img src="{{url($img->url)}}" alt="" class="my-auto w-10 sm:w-14 h-10 sm:h-14 rounded-3xl border border-solid">
            @endif
            @endforeach
            @else
            <img src="#" alt="" class="my-auto w-14 h-14 rounded-3xl border border-solid">
            @endif
            <p class="py-1 px-1 my-auto line-clamp-2 text-xs sm:text-base">{{$choice->title}}</p>
        </div>
        <hr>
        @endforeach
    </div>
@endif