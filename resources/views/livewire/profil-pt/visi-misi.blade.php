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
                    <div class="w-full rounded border border-solid py-8 px-10">
                        {!! $vimi->visi_misi !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-4/12 sm:pl-4 sm:pr-8 flex flex-col">
            <livewire:layouts.right-menu/>
        </div>
    </div>
</div>