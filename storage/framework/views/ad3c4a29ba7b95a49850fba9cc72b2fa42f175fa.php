 <?php $__env->slot('header', null, []); ?> 
    <div class="bg-white">
        <div class="hidden sm:flex max-w-7xl mx-auto">
            <img class="object-contain h-full w-full" src="<?php echo e(url('storage/photos/bkerjafixxx.jpg')); ?>">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-56 w-full" src="<?php echo e(url('storage/photos/hp.jpg')); ?>">
        </div>
    </div>
 <?php $__env->endSlot(); ?>

 <?php $__env->slot('footer', null, []); ?> 
 <?php $__env->endSlot(); ?>

<div class="py-12 bg-yellow bg-fixed ..." >
            <div class="flex-auto ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 -mt-24 lg:-mt-28">
                    <div class=" justify-center">
                        <div class="flex justify-center ...">
                            <div class="w-full shadow-xl p-5 rounded-lg bg-white">
                            <div class="flex flex-col sm:flex-row">

                            <div class="relative w-full sm:w-80 mr-1 mb-1">

                                    <div class="absolute flex items-center ml-2 mt-2">

                                    <lord-icon
                                        src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop"
                                        colors="primary:#1b1091,secondary:#1663c7"
                                        style="width:30px;height:30px">
                                    </lord-icon>

                                    </div>



                                    <input type="search" id="search-title" list="title-list" wire:model="searchjob" name="searchjob" type="text" placeholder="Pekerjaan, kata kunci, atau nama perusahaan" 

                                    class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">


                            </div>

                            <div class="w-full sm:w-80 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                                    <div class="absolute flex items-center ml-2 mt-2 ">

                                        <lord-icon
                                            src="https://cdn.lordicon.com/zzcjjxew.json"
                                            trigger="loop"
                                            colors="primary:#2516c7,secondary:#30c9e8"
                                            style="width:32px;height:32px">
                                        </lord-icon>

                                    </div>

                                    <input id="search-loc" wire:model.defer="locations" type="search" placeholder="Lokasi" 
                                    class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                            </div>

                            <div class="w-full sm:w-80 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                                    <div class="absolute flex items-center ml-2 mt-2">

                                        <lord-icon
                                            src="https://cdn.lordicon.com/soseozvi.json"
                                            trigger="loop"
                                            colors="primary:#1b1091,secondary:#66d7ee"
                                            style="width:32px;height:32px">
                                        </lord-icon>

                                    </div>

                            </div>

                            <div class="hidden lg:flex sm:w-48 ml-0 sm:ml-1 mr-0 sm:mr-1 mb-1 sm:mb-0 grid justify-items-end">

                                <button wire:click="searchJobs()" data-mdb-ripple="true"

                                    data-mdb-ripple-color="light"

                                    class="search-myjob w-full sm:w-48 justify-end inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                                    SEARCH

                                </button>

                            </div>

                            </div>

                            <div class="flex lg:hidden grid justify-items-end">

                                <button wire:click="searchJobs()" data-mdb-ripple="true"

                                    data-mdb-ripple-color="light"

                                    class="search-myjob w-full justify-end inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                                    SEARCH

                                </button>

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="max-w-7xl mx-auto lg:px-8 pt-4">
        <div class="cyanshadow bg-white overflow-hidden sm:rounded-lg px-4 pt-4">
        <p class="secondary-heading">Job Recommendation</p>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('slider', [])->html();
} elseif ($_instance->childHasBeenRendered('l2054633988-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2054633988-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2054633988-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2054633988-0');
} else {
    $response = \Livewire\Livewire::mount('slider', []);
    $html = $response->html();
    $_instance->logRenderedChild('l2054633988-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
</div>
            

<div class="banner sm:hidden flex flex-row fixed justify-center z-50 left-0 right-0 bottom-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/stylee.css')); ?>">

</head>

<body class="bodyy">

    <ul class="nav">
        <span class="nav-indicator"></span>
        <li>
            <a class="animate-bounce" href="<?php echo e(url('account')); ?>">
                <ion-icon name="people-circle-outline"></ion-icon>
                <span class="title">About Us</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('lowongan/sj_send=')); ?>">
                <ion-icon name="search-outline"></ion-icon>
                <span class="title">Search</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('')); ?>" class="nav-item-active">
                <ion-icon name="home-outline"></ion-icon>
                <span class="title">Homepage</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('/user/saveloker')); ?>">
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
    var route = "<?php echo e(url('autocomplete-search')); ?>";
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
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/main.blade.php ENDPATH**/ ?>