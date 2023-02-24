<x-slot name="admin">
</x-slot>
<x-slot name="footer">
</x-slot>
<x-slot name="header">
    <p class="w-1/2 mx-0.5 text-left font-bold text-base sm:text-lg">Edit Categories</p>
    <p class="w-full m-0.5 text-right">
        <a href="{{route('admin.dashboard')}}" class="hover:text-cyan-500 hover:underline">Admin</a>
        /
        <a href="{{route('admin.profilept.vimi')}}" class="hover:text-cyan-500 hover:underline">Visi & Misi</a>
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
        <button wire:click="edit(@if($vimi){{$vimi->id}}@else{{'null'}}@endif)"
            class="loadings inline-flex items-center px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Edit
        </button>
        <div class="w-full rounded border border-solid py-8 px-10">
            {!! $vimi->visi_misi !!}
        </div>
        @if ($isOpen)
            @include('livewire.admin.profile-pt.create')
        @endif
    </div>
</div>