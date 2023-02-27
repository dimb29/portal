<x-slot name="admin">
</x-slot>
<x-slot name="footer">
</x-slot>
<x-slot name="header">
    <p class="w-1/2 mx-0.5 text-left font-bold text-base sm:text-lg">Edit Categories</p>
    <p class="w-full m-0.5 text-right">
        <a href="{{route('admin.dashboard')}}" class="hover:text-cyan-500 hover:underline">Admin</a>
        /
        <a href="{{route('admin.filter.categories')}}" class="hover:text-cyan-500 hover:underline">Category</a>
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
            Create New Category
        </button>
        <div class="flex flex-row mb-2">
            <input type="text" wire:model="search" placeholder="search.." 
            class="py-2 px-1 w-1/2 sm:w-1/4 mx-0.5 border border-solid focus:outline-none">
            <select name="short" id="short" wire:model="short"
            class="py-2 px-1 w-1/2 sm:w-1/4 mx-0.5 border border-solid focus:outline-none">
                <option value="">urutkan</option>
                <option value="1">A-Z</option>
                <option value="2">Z-A</option>
                <option value="3">Terbaru</option>
                <option value="4">Terlama</option>
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
                @foreach($categories as $category)
                <tr>
                    <td class="text-center border border-slate-300">{{$category->id}}</td>
                    <td class="border border-slate-300 px-1 truncate">{{$category->title}}</td>
                    <td class="text-center border border-slate-300 w-1/4">
                        <button wire:click="edit({{$category->id}})" class="py-2 px-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 focus:outline-none focus:border-blue-600 focus:shadow-outline-red active:bg-blue-500 transition ease-in-out duration-150"><i class="fa-regular fa-pen-to-square"></i></button>
                        <x-jet-delete-button id="{{$category->id}}" wire:click="delete({{$category->id}})" 
                        class="del-btn inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            <i class="fa-regular fa-trash-can"></i>
                        </x-jet-delete-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>{{$categories->links()}}</p>
        @if ($isOpen)
            @include('livewire.admin.filters.create')
        @endif
    </div>
</div>