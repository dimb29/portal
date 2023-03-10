<x-slot name="header">
    <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Post
    </h2> -->
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="mt-20 max-w-6xl mx-auto">
<div wire:loading class="fixed z-20 inset-0 place-content-center ">
    <div class="fixed justify-center h-full w-full opacity-25 bg-slate-300"> </div>
        <div class="flex justify-center my-72">
            <div class="my-48 dots">
            </div>
        </div>
</div>
    <div class="flex flex-col sm:flex-row">
        <div class="w-full sm:w-8/12 sm:pl-8 sm:pr-4">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="flex justify-center">

                    <div id="fixed-share">
                        <div class="flex flex-row max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="text-center font-bold textl80">
                                {{$post->title}}
                            </div>
                            <div class="ml-4">Bagikan</div>
                        </div>
                    </div>

                    <div class="">

                        <div class="text-center text-blue-700 font-bold text-2xl sm:text-3xl mb-2">
                            {{$post->title}}
                        </div>
                        <h5 class="text-lg font-medium text-center">
                            @php
                            $regens = $post->regency;
                            $dists = $post->district;
                            for($i=0;$i < count($regens);$i++){
                            if($i+1 == count($regens)){
                                echo ucwords(strtolower($regens[$i]->name));
                            }else{
                                echo ucwords(strtolower($regens[$i]->name.", "));
                                }
                            }
                            for($i=0;$i < count($dists);$i++){
                            if($i+1 == count($dists)){
                                echo ucwords(strtolower(", ".$dists[$i]->name));
                            }else{
                                echo ucwords(strtolower($dists[$i]->name.", "));
                                }
                            }
                            @endphp
                        </h5>
                            <div class="flex flex-row justify-center">
                                <p>by&nbsp;<span class="italic">{{ $post->author->first_name . ' ' . $post->author->last_name }}</span></p>
                                &nbsp;on&nbsp;{{ $post->updated_at->format('l, d F Y') }}
                            </div>
                        <div id="location" data-id="{{$post->location_id}}"></div>
                    </div>

                </div>

                <div class="flex-auto m-1 border-blue-500 border-b-2">
                    <div class="grid grid-flow-col">
                        <div class="py-4">
                        @if(count($post->images) != 0)
                        @foreach ($post['images'] as $image)
                            <img class="h-full sm:h-96" src="{{ url($image->url) }}" alt="{{ $image->description }}" width="100%">
                        @endforeach
                        @else
                            <img class="h-full sm:h-72" width="100%" src="{{ url('storage/photos/default_jobs.png') }}" alt="this is default">
                        @endif
                        </div>
                    </div>

                    <div wire:ignore id="content{{$post->id}}" class="p-3 text-gray-700 text-base m-auto" readonly="readonly" x-data
                        >
                        <p>{!! $post->content !!}</p>
                    </div>
                    <div class="inline-flex ml-3 mt-4 text-xl">
                        <i wire:click="@if($user_like) UnLikeIt([{{$post->id}}]) @else LikeIt([{{$post->id}}]) @endif" 
                        class="@if($user_like) fa-solid @else fa-regular @endif fa-thumbs-up mx-1 my-auto cursor-pointer"></i>
                        <p wire:click="@if($user_like) UnLikeIt([{{$post->id}}]) @else LikeIt([{{$post->id}}]) @endif" 
                            class="mr-2 my-auto text-gray-500 text-sm cursor-pointer mt-1">
                            @if(count($post->like) > 0)
                                {{count($post->like)}} 
                            @endif
                            Suka
                        </p> 
                    </div>
                    
                    <div class="flex flex-row ml-3">
                        <div class="mb-4">
                            <input type="text" value="{{url('posts/'.$post->id)}}" id="myInput" class="invisible">
                            <p class="mb-3 text-2xl"> 
                                <ion-icon class="z-0 mr-3 mt-2" name="share-social-outline"></ion-icon>Bagikan
                            </p>
                            <button onclick="copyLink()" data-id="{{$post->id}}" class="mr-1 w-8 h-8 text-indigo-100 transition-colors p-1 duration-150 bg-indigo-700 rounded-full focus:shadow-outline hover:bg-indigo-800">
                                <i class="fa-solid fa-link"></i>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="my-6">
                <livewire:comment.comment :post_id="$post->id"/>
            </div>
        </div>
        <div class="w-full sm:w-4/12 sm:pl-4 sm:pr-8 flex flex-col">
            <livewire:layouts.right-menu/>
        </div>
    </div>
</div>

<style>
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border: 0;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .then( editor => {
            const toolbarElement = editor.ui.view.toolbar.element;
            toolbarElement.style.display = "none";
            editor.enableReadOnlyMode( '#content' );
        } )
        .catch(error => {
            console.error(error);
        });

        window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            document.getElementById("fixed-share").style.display = "block";
        } else {
            document.getElementById("fixed-share").style.display = "none";
        }
        });

function copyLink() {
  var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999); 

  navigator.clipboard.writeText(copyText.value);
  
  alert("Tautan Berhasil Disalin");
}

</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky1");
  } else {
    header.classList.remove("sticky1");
  }
}
</script>


<script>
var stickyOffset = $('.stickyy').offset().top;

$(window).scroll(function(){
  var sticky = $('.stickyy'),
      scroll = $(window).scrollTop();

  if (scroll >= stickyOffset) sticky.addClass('fixme');
  else sticky.removeClass('fixme');
});
</script>