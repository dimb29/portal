<x-slot name="header">
    <div class="bg-white">
        <div class="hidden sm:flex max-w-7xl mx-auto">
            <img class="object-contain h-full w-full" src="{{url('storage/photos/banner.jpg')}}">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-56 w-full" src="{{url('storage/photos/hp.jpg')}}">
        </div>
    </div>
</x-slot>

<x-slot name="footer">
</x-slot>

<div class="py-12 bg-yellow bg-fixed ..." >

    <div class="flex flex-col sm:flex-row">
        <div class="w-full sm:w-3/4 sm:pl-8 sm:pr-4">
            <div class="mt-4 sm:mt-8">
                <div class="flex flex-row items-end">
                    <p class="border-b-4 border-solid border-b-blue-500 text-sm sm:text-xl">Hasil Pencarian "{{$search}}"</p>
                </div>
                <div class="flex flex-col mt-4">
                    @if($allposts)
                    @foreach($allposts as $allpost)
                    <div class="flex flex-row item-center h-14 sm:h-40 my-1 hover:text-blue-500 cursor-pointer">
                        @if($allpost->images)
                        @foreach($allpost->images as $image)
                        <img src="{{url($image->url)}}" alt="photo-news"
                        class="w-1/4 h-full object-cover border border-solid">
                        @endforeach
                        @else
                        <img src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="photo-news"
                        class="w-1/4 h-full object-cover border border-solid">
                        @endif
                        <div class="flex flex-col w-3/4 ml-4 my-auto">
                            <p class="text-sm sm:text-xl line-clamp-1 sm:line-clamp-2">{{$allpost->title}}</p>
                            <p class="text-xs sm:text-base text-gray-500">{{ $allpost->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/4 sm:pl-4 sm:pr-8 flex flex-col">
            <livewire:layouts.right-menu/>
        </div>
    </div>
</div>