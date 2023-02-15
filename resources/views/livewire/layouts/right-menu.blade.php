<div class="flex flex-col">
    <div>
        @if($populers)
            <div class="shadow-sm mb-4">
                <div class="flex flex-col">
                    <div class="flex flex-row border-b border-solid border-gray-500">
                        <div class="w-5/12 mx-auto pr-14 sm:pr-5">
                            <p class="py-1 ml-2 sm:ml-0 font-bold text-lg text-left sm:text-center text-gray-800 border-b-4 border-solid border-blue-500">TERPOPULER</p>
                        </div>
                        <div class="w-7/12 sm:w-0">
                            <p class=""></p>
                        </div>
                    </div>
                    @foreach($populers as $key => $populer)
                    <a href="{{url('posts/'.$populer->id)}}" class="border-b bg-white">
                        <div class="flex flex-row m-2 sm:m-0 bg-white sm:bg-gray-100">
                            <div class="w-1/12 sm:w-1/5 bg-none sm:bg-blue-500 text-blue-500 sm:text-white text-center">
                                <p class="mt-0 sm:mt-4 mx-auto h-full text-center align-middle text-4xl sm:text-xl font-bold" style="transform: skewX(-10deg);">{{$key+1}}</p>
                            </div>
                            <div class="mx-2 w-8/12 sm:w-4/5">
                                <p class="textl py-1 px-1 my-auto text-base">{{$populer->title}}</p>
                            </div>
                            <div class="flex sm:hidden w-3/12">
                                @if($populer->images)
                                @foreach($populer->images as $image)
                                <img src="{{url($image->url)}}" alt="photo-news"
                                class="w-full h-24 sm:h-32 object-cover">
                                @endforeach
                                @else
                                <img src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="photo-news"
                                class="w-full h-24 sm:h-32 object-cover">
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div>
        @if($comments)
            <div class="border border-b shadow-sm mb-4">
                <p class="py-2 px-1 border-b-4 bg-white border-solid border-b-blue-500 text-base sm:text-lg text-center">Komentar Terhangat</p>
                @foreach($comments as $comment)
                <a href="{{url('posts/'.$comment->post->id)}}" class="flex flex-row bg-white sm:bg-gray-100 py-1 px-1">
                    @if($comment->author->profile_photo_url)
                    <img src="{{url($comment->author->profile_photo_url)}}" alt="" class="my-auto w-10 sm:w-14 h-10 sm:h-14 rounded-3xl border border-solid">
                    @else
                    <img src="#" alt="" class="my-auto w-14 h-14 rounded-3xl border border-solid">
                    @endif
                    <div class="px-1">
                        <p class="font-bold truncate text-base sm:text-base">{{$comment->author->name}}</p>
                        <p class="line-clamp-1 sm:line-clamp-2 text-sm sm:text-sm">{{$comment->comment}}</p>
                    </div>
                </a>
                <hr>
                @endforeach
            </div>
        @endif
    </div>
    <div>
        @if(count($choices) > 0)
            <div class="shadow-sm mb-4">
                <div class="flex flex-col">
                    <div class="flex flex-row border-b border-solid border-gray-500">
                        <div class="w-5/12 mx-auto pr-14 sm:pr-5">
                            <p class="py-1 ml-2 sm:ml-0 font-bold text-lg text-left sm:text-center text-gray-800 border-b-4 border-solid border-blue-500">Berita Pilihan</p>
                        </div>
                        <div class="w-7/12 sm:w-0">
                            <p class=""></p>
                        </div>
                    </div>
                    @foreach($choices as $choice)
                    <a href="{{url('posts/'.$choice->id)}}" class="border-b bg-white">
                        <div class="flex flex-row m-2 sm:m-0 bg-white sm:bg-gray-100">
                            <div class="flex sm:hidden w-3/12">
                                @if($choice->images)
                                @foreach($choice->images as $image)
                                <img src="{{url($image->url)}}" alt="photo-news"
                                class="w-full h-24 sm:h-32 object-cover">
                                @endforeach
                                @else
                                <img src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="photo-news"
                                class="w-full h-24 sm:h-32 object-cover">
                                @endif
                            </div>
                            <div class="hidden sm:flex w-1/12 ml-4 mt-3 my-2">
                                <i class="ml-2 fa-solid fa-quote-left"></i>
                            </div>
                            <div class="w-9/12 sm:w-11/12 my-2">
                                <p class="px-3 my-auto text-base sm:text-base">{{$choice->title}}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>