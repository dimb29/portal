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
        @if($headlines)
        <div class="w-full sm:w-3/4 sm:pl-8 sm:pr-4">
            @foreach($headlines as $headline)
            @if($loop->first)
            <div class="relative w-full bg-gray-800 text-white hover:text-blue-500 cursor-pointer">
                @if($headline->images)
                @foreach($headline->images as $image)
                <img class="static top-0 w-full h-96 object-cover" src="{{url($image->url)}}" alt="foto-berita">
                @endforeach
                @else
                <img class="static top-0 w-full h-96 object-cover" src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="foto-berita">
                @endif
                <p class="absolute top-0 bg-fuchsia-600 text-white shadow-md rounded-r-lg py-1 px-1 mt-4">HEADLINE</p>
                <p class="absolute inset-x-0 bottom-0 pb-0.5 sm:pb-4 px-1 sm:px-2 font-bold text-sm sm:text-3xl
                bg-gradient-to-t from-gray-900 to-gray-600/50">
                    {{$headline->title}}
                </p>
            </div>
            @endif
            @endforeach
            <div class="w-full bg-gray-900 px-1 pb-1 grid grid-cols-4 gap-4">
                @foreach($headlines as $headline)
                @if(!($loop->first))
                <div class="h-20 sm:h-52 border border-solid hover:border-blue-500 text-white hover:text-blue-500 cursor-pointer">
                    @if($headline->images)
                        @foreach($headline->images as $image)
                            <img src="{{url($image->url)}}" alt="photo-news" class="w-full h-10 sm:h-40 object-cover">
                        @endforeach
                    @else
                        <img src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="photo-news" class="w-full h-10 sm:h-40 object-cover">
                    @endif
                    <p class="text-xs sm:text-base sm:font-bold sm:my-0.5 mx-1 line-clamp-2">
                        {{$headline->title}}
                    </p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="mt-4 sm:mt-8">
                <div class="flex flex-row items-end">
                    <div class="w-3/12 sm:w-2/12 pl-0.5">
                        <p class="border-b-4 border-solid border-b-blue-500 font-bold text-sm sm:text-xl">Berita Terkini</p>
                    </div>
                    <div class="w-9/12 sm:w-10/12 pr-0.5">
                        <p class="border-b border-solid text-xs sm:text-base text-right text-blue-400"><a href="#">lihat semua</a></p>
                    </div>
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
        @endif
        <div class="w-full sm:w-1/4 sm:pl-4 sm:pr-8 flex flex-col">
            <livewire:layouts.right-menu/>
        </div>
    </div>
</div>
            

<div class="banner sm:hidden flex flex-row fixed justify-center z-50 left-0 right-0 bottom-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylee.css') }}">

</head>

<body class="bodyy">

    <ul class="nav">
        <span class="nav-indicator"></span>
        <li>
            <a class="animate-bounce" href="{{ url('account') }}">
                <ion-icon name="people-circle-outline"></ion-icon>
                <span class="title">About Us</span>
            </a>
        </li>
        <li>
            <a href="{{ url('lowongan/sj_send=') }}">
                <ion-icon name="search-outline"></ion-icon>
                <span class="title">Search</span>
            </a>
        </li>
        <li>
            <a href="{{ url('') }}" class="nav-item-active">
                <ion-icon name="home-outline"></ion-icon>
                <span class="title">Homepage</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/saveloker') }}">
                <ion-icon name="bookmarks-outline"></ion-icon>
                <span class="title">Bookmark</span>
            </a>
        </li>
        <li>
            <a class="open-side">
                <ion-icon name="person-outline"></ion-icon>
                <span class="title">Account</span>
            </a>
        </li>
    </ul>


    <!-- https://css-tricks.com/gooey-effect/ -->

    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="filter-svg">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>
        </defs>
    </svg>

    

</body>
</div>


<script>
    $(document).ready(function(){
    if($('.myframe').is(":visible")){
        $('.slider').slick({
            arrows: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: true,
            touchMove: true,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    }else{
        $('.slider').slick({
            arrows: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            draggable: true,
            touchMove: true,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    }
        $('.slider2').slick({
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                draggable: true,
                touchMove: true,
                autoplay: true,
                autoplaySpeed: 1000,
        });
 
            window.onscroll = function (ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('post-data');
                }
            };
    });
    var route = "{{ url('autocomplete-search') }}";
    $('#search-loc').typeahead({
        source: function (query, process) {
            var dataquery = query;
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
    $('#search-loc').on('change',function(){
        console.log($(this).val())
        $sloc_val = $(this).val()
        window.livewire.emit('dataLocation',$sloc_val)
    })


let nav = document.querySelector('.nav')

nav.querySelectorAll('li a').forEach((a, i) => {
a.onclick = (e) => {
if (a.classList.contains('nav-item-active')) return

nav.querySelectorAll('li a').forEach(el => {
    el.classList.remove('nav-item-active')
})

a.classList.add('nav-item-active')

let nav_indicator = nav.querySelector('.nav-indicator')

nav_indicator.style.left = `calc(${(i * 80) + 40}px - 45px)`
}
})


$(document).ready(function() {

$('.sel-loc').select2();

});



var lastScrollTop = 0;
$(window).scroll(function(){
  var st = $(this).scrollTop();
  var banner = $('.banner');
  setTimeout(function(){
    if (st > lastScrollTop){
      banner.addClass('hide');
    } else {
      banner.removeClass('hide');
    }
    lastScrollTop = st;
  }, 100);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>