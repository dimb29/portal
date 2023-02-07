<x-slot name="admin">
</x-slot>
<div class="w-full px-1 sm:px-8 py-1 sm:py-8">
    <div class="flex flex-row w-full px-1 sm:px-2 py-2 sm:py-3">
        <p class="w-1/4 mx-0.5 text-center border border-solid">Edit Posts</p>
        <p class="w-full m-0.5 text-right border border-solid">
            <a href="{{route('admin.dashboard')}}" class="hover:text-cyan-500 hover:underline">Admin</a>
            /
            <a href="{{route('admin.posts')}}" class="hover:text-cyan-500 hover:underline">Post</a>
        </p>
    </div>
</div>