<x-slot name="admin">
</x-slot>
<x-slot name="header">
    <p class="w-1/2 mx-0.5 text-left font-bold text-base sm:text-lg">Edit Posts</p>
    <p class="w-full m-0.5 text-right">
        <a href="{{route('admin.dashboard')}}" class="hover:text-cyan-500 hover:underline">Admin</a>
        /
        <a href="{{route('admin.posts')}}" class="hover:text-cyan-500 hover:underline">Post</a>
    </p>
</x-slot>
<div class="w-full px-1 sm:px-8 py-1 sm:py-4">
    <div class="py-4 px-3 overflow-x-auto">
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
        <div class="flex flex-row mb-2">
            <input type="text" wire:model="search" placeholder="search.." 
            class="py-2 px-1 w-1/3 sm:w-1/4 mx-0.5 border border-solid focus:outline-none">
            <select name="short" id="short" wire:model="short"
            class="py-2 px-1 w-1/3 sm:w-1/4 mx-0.5 border border-solid focus:outline-none">
                <option value="">urutkan</option>
                <option value="1">A-Z</option>
                <option value="2">Z-A</option>
                <option value="3">Terbaru</option>
                <option value="4">Terlama</option>
            </select>
            <select name="filter_verif" id="filter_verif" wire:model="filter_verif"
            class="py-2 px-1 w-1/3 sm:w-1/4 mx-0.5 border border-solid focus:outline-none">
                <option value="">filter</option>
                <option value="1">Belum Verifikasi</option>
                <option value="2">Terverifikasi</option>
                <option value="3">Verifikasi Ditolak</option>
            </select>
        </div>
        <table class="w-full border-collapse border border-slate-400">
            <thead>
                <tr>
                    <th class="border border-slate-300">ID</th>
                    <th class="border border-slate-300">Judul</th>
                    <th class="border border-slate-300">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr class="@if($post->verified == 1) bg-green-100 @elseif($post->verified == 2) bg-red-100 @endif">
                    <td class="text-center border border-slate-300">{{$post->id}}</td>
                    <td class="border border-slate-300 px-1">{{$post->title}}</td>
                    <td class="text-center border border-slate-300 w-1/4">
                        <button wire:click="verify({{$post->id}})" class="py-2 px-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-400 focus:outline-none focus:border-green-600 focus:shadow-outline-red active:bg-green-500 transition ease-in-out duration-150"><i class="fa-regular fa-square-check"></i></button>
                        <button wire:click="edit({{$post->id}})" class="py-2 px-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 focus:outline-none focus:border-blue-600 focus:shadow-outline-red active:bg-blue-500 transition ease-in-out duration-150"><i class="fa-regular fa-pen-to-square"></i></button>
                        <x-jet-delete-button id="{{$post->id}}" wire:click="delete({{$post->id}})" 
                        class="del-btn inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            <i class="fa-regular fa-trash-can"></i>
                        </x-jet-delete-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <p>{{$posts->links()}}</p>
        @if ($isOpen)
            @include('livewire.admin.posts.post-create')
        @endif
        @if ($isVerify)
            @include('livewire.admin.posts.post-verify')
        @endif
    </div>
</div>

<script>
    //Once add button is clicked
    var numb = 1;
    function addLocation(nameloc){
    var maxField = 6; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('#wrapper-box'); //Input field wrapper
    // var tvalue = $('#title').val();
        var tvalue = nameloc;
        if(tvalue != ""){
            //Check maximum number of input fieldsconsole.log(add_div)
            var d_exist = $("option[value='" + nameloc + "']").val() == nameloc;
            if(!d_exist){
                if(numb < maxField){ 
                    var add_div = "<option selected data-id='op-"+numb+"-ch' value='"+tvalue+"'>"+tvalue+"</option>";
                    var fieldHTML = "<div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='"+tvalue+"'>"+
                                    "<span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>"+
                                    '<a href="javascript:void(0);" data-id="op-'+numb+'-ch" onclick="delLocation(`op-'+numb+'-ch`)" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>'+
                                    '<span class="text-md my-1 mx-1">'+tvalue+"</span></span></div>"; //New input field html 
                    // console.log(add_div)
                    // console.log(fieldHTML)
                    numb++; //Increment field counter  
                    $('#multiloc').append(add_div);
                    $(wrapper).append(fieldHTML); //Add field html
                    $('#inloc').val("");
                    var multval = $('#multiloc').val();
                    window.livewire.emit('multiLoc',multval)
                }else{
                    alert('Anda hanya dapat menambahkan 5 judul');
                }
            }
        }
    };
    function delLocation(locid){
        // e.preventDefault();
        var selId = locid;
        console.log(selId);
        $("a[data-id='" + selId + "']").parent('span').parent('div').remove(); //Remove field html
        $("option[data-id='" + selId + "']").remove(); 
        numb--; //Decrement field counter
        var multval = $('#multiloc').val();
        window.livewire.emit('multiLoc',multval)
    }
</script>