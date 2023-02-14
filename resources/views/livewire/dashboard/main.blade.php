<x-slot name="header">
    <!-- <div class="bg-white">
        <div class="hidden sm:flex max-w-7xl mx-auto">
            <img class="object-contain h-full w-full" src="{{url('storage/photos/banner.jpg')}}">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-56 w-full" src="{{url('storage/photos/hp.jpg')}}">
        </div>
    </div> -->
</x-slot>

<x-slot name="footer">
</x-slot>

<div class="bg-yellow sm:bg-white bg-fixed mt-20" >

    <div class="flex flex-col sm:flex-row max-w-6xl mx-auto">
        @if($headlines)
        <div class="w-full sm:w-2/3 sm:pl-8 sm:pr-4">
            @foreach($headlines as $headline)
            @if($loop->first)
            <a href="{{url('posts/'.$headline->id)}}" class="relative w-full bg-gray-800 text-white hover:text-blue-500 cursor-pointer">
                @if($headline->images)
                @foreach($headline->images as $image)
                <img class="static top-0 w-full h-96 object-cover" src="{{url($image->url)}}" alt="foto-berita">
                @endforeach
                @else
                <img class="static top-0 w-full h-96 object-cover" src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="foto-berita">
                @endif
                <p class="absolute top-0 bg-white text-blue-300 shadow-md rounded-r-lg py-1 pl-2 pr-4 mt-4 font-bold">HEADLINE</p>
                <p class="texl1 pt-3 absolute inset-x-0 bottom-0 px-1 sm:px-2 text-sm sm:text-3xl" style="background: rgba(0, 0, 0, 0.5);">
                    {{$headline->title}}
                </p>
            </a>
            @endif
            @endforeach
            <div class="w-full bg-gray-900 px-1 pb-1 grid grid-cols-4 gap-1">
                @foreach($headlines as $headline)
                @if(!($loop->first))
                <a href="{{url('posts/'.$headline->id)}}" class="h-20 sm:h-auto border border-solid hover:border-blue-500 text-white hover:text-blue-500 cursor-pointer">
                    @if($headline->images)
                        @foreach($headline->images as $image)
                            <img src="{{url($image->url)}}" alt="photo-news" class="w-full h-10 sm:h-24 object-cover">
                        @endforeach
                    @else
                        <img src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="photo-news" class="w-full h-10 sm:h-24 object-cover">
                    @endif
                    <p class="textl2 text-xs sm:my-0.5 mx-1">
                        {{$headline->title}}
                    </p>
                </a>
                @endif
                @endforeach
            </div>
            <div class="mt-4 sm:mt-8">
                <div class="flex flex-row border-b border-solid border-gray-400">
                    <div class="w-5/12 sm:w-3/12 ml-2 sm:ml-0 pr-10 sm:pr-5">
                        <p class="border-b-4 border-solid border-blue-500 font-bold text-lg">BERITA TERKINI</p>
                    </div>
                    <div class="w-7/12 sm:w-9/12 pr-0.5">
                        <p class="text-xs sm:text-sm text-right text-blue-400"><a href="#">LIHAT SEMUA</a></p>
                    </div>
                </div>
                <div class="flex flex-col bg-white">
                    @if($allposts)
                    @foreach($allposts as $allpost)
                    <a href="{{url('posts/'.$allpost->id)}}" class="border-b sm:border-0 border-gray-200">
                        <div class="flex flex-row item-center h-auto mb-2 sm:mb-3 mt-2 sm:mt-0 mx-2 sm:mx-0 hover:text-blue-500 cursor-pointer">
                            <div class="w-1/4 rounded-lg">
                                @if($allpost->images)
                                @foreach($allpost->images as $image)
                                <img src="{{url($image->url)}}" alt="photo-news"
                                class="w-full h-24 sm:h-32 object-cover">
                                @endforeach
                                @else
                                <img src="{{url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')}}" alt="photo-news"
                                class="w-full h-24 sm:h-32 object-cover">
                                @endif
                            </div>
                            <div class="flex flex-col w-3/4 h-24 sm:h-32 ml-4 border-0 sm:border-b">
                                <div class="">
                                    <p class="textl text-base sm:text-2xl">{{$allpost->title}}</p>
                                </div>
                                <div class="mt-auto">
                                    <p class="text-xs sm:text-base text-gray-500">{{ $allpost->created_at->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endif
        <div class="w-full mt-4 sm:mt-0 sm:w-1/3 sm:pl-4 sm:pr-8 flex flex-col">
            <livewire:layouts.right-menu/>
        </div>
    </div>
</div>

<style>
    * {
        font-family: Roboto,sans-serif;
        font-weight: 300;
    }
</style>
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