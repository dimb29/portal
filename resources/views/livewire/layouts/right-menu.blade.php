@if($populers)
    <div class="shadow-sm mb-4">
        <p class="py-2 px-1 border-b border-solid bg-blue-500 text-sm sm:text-lg text-white text-center">Terpopuler</p>
        @foreach($populers as $key => $populer)
        <div class="flex flex-row bg-white sm:bg-gray-100 border-b">
            <div class="w-1/5 bg-blue-500 text-white text-center">
                <p class="mt-4 mx-auto h-full text-center align-middle text-base sm:text-base font-bold">{{$key+1}}</p>
            </div>
            <div class="w-4/5">
                <p class="textl py-1 px-1 my-auto text-sm sm:text-base">{{$populer->title}}</p>
            </div>
        </div>
        @endforeach
    </div>
@endif
@if($comments)
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b-4 bg-white border-solid border-b-blue-500 text-sm sm:text-lg text-center">Komentar Terhangat</p>
        @foreach($comments as $comment)
        <div class="flex flex-row bg-white sm:bg-gray-100 py-1 px-1">
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
    <div class="shadow-sm mb-4">
        <p class="py-2 px-1 bg-blue-500 text-sm sm:text-lg text-white text-center">Berita Pilihan</p>
        @foreach($choices as $choice)
        <div class="flex flex-row py-1 px-1 bg-white sm:bg-gray-100 border-b">
            <div class="w-1/12">
                <i class="ml-2 fa-solid fa-quote-left"></i>
            </div>
            <div class="w-11/12">
                <p class="px-1 my-auto line-clamp-2 text-xs sm:text-base">{{$choice->title}}</p>
            </div>
        </div>
        @endforeach
    </div>
@endif