<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Upload Berita
    </h2>
<div class="loading-div fixed z-20 inset-0 place-content-center" hidden>
    <div class="fixed justify-center h-full w-full opacity-25 bg-gray-400"> </div>
    <div class="flex justify-center mt-12">
            <div class="dots mt-96"> </div>
    </div>
</div>
</x-slot>

<div class="py-40">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
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
            <button wire:click="create()"
                class="loadings inline-flex items-center px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Create New Post
            </button>
            @if ($isOpen)
                @include('livewire.posts.create')
            @endif
            <div class="grid grid-flow-row grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    @if(Auth::user()->user_type == 'administr')
                    <div class="max-w-full sm:max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4 text-more__container">
                            <div class="font-bold text-xl mb-2">
                            {{($post->title)}}
                            </div>
                            <p class="text-gray-700 text-base">
                                {!! ($post->content) !!}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <a href="{{ url('posts', $post->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Read post
                            </a>
                            <button wire:click="edit({{ $post->id }})"
                                class="loadings inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                            <x-jet-delete-button id="{{$post->id}}" wire:click="delete({{$post->id}})" 
                            class="del-btn inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Delete
                            </x-jet-delete-button>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="py-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.loadings').click(function(){
            $('.loading-div').show();
            $('.loading-div').delay(4000).fadeOut();
        })
        $('.del-btn').click(function(){
            var dataId = $(this).attr('data-id')
            $('.sure-del').attr("wire:click", 'delete('+dataId+')')
            // alert('berhasil')
        })
    })
    
    //Once add button is clicked
    function addLocation(nameloc){
    var numb = 1;
    var maxField = 6; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('#wrapper-box'); //Input field wrapper
    // var tvalue = $('#title').val();
    var x = 1; //Initial field counter is 1
        var tvalue = nameloc;
        if(tvalue != ""){
            //Check maximum number of input fieldsconsole.log(add_div)
            if(x < maxField){ 
                var add_div = "<option selected data-id='op-"+numb+"-ch' value='"+tvalue+"'>"+tvalue+"</option>";
                var fieldHTML = "<div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='"+tvalue+"'>"+
                                "<span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>"+
                                '<a href="javascript:void(0);" data-id="op-'+numb+'-ch" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>'+
                                '<span class="text-md my-1 mx-1">'+tvalue+"</span></span></div>"; //New input field html 
                console.log(add_div)
                console.log(fieldHTML)
                x++; //Increment field counter  
                $('#multiloc').append(add_div);
                $(wrapper).append(fieldHTML); //Add field html
                numb++;
                $('#inloc').val("");
                var multval = $('#multiloc').val();
                window.livewire.emit('multiLoc',multval)
            }else{
                alert('Anda hanya dapat menambahkan 5 judul');
            }
        }
    };
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('span').parent('div').remove(); //Remove field html
        var selId = $(this).attr('data-id');
        console.log(selId);
        $("option[data-id='" + selId + "']").remove(); 
        x--; //Decrement field counter
        var multval = $('#multiloc').val();
        window.livewire.emit('multiLoc',multval)
    });
</script>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
