<div class="relative mt-2 mx-auto w-60 sm:w-80 mb-1" x-data="{searchmodal:false}">
    <div class="absolute flex z-50 items-center ml-2 mt-2">
    <lord-icon
    	src="https://cdn.lordicon.com/msoeawqm.json"
		trigger="loop"
		colors="primary:#1b1091,secondary:#1663c7"
		style="width:30px;height:30px">
	</lord-icon>
    </div>
    <input id="searchbox" autocomplete="off" wire:model="search_bar" x-on:keydown="searchmodal = true" x-on:keydown.enter="getUrl()" type="text" class="pl-11 pr-4 h-12 w-full rounded-md shadow-md bg-blue-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm" placeholder="Search anything you want :)">
    <div x-show="searchmodal" class="fixed modal z-10 bg-white rounded rounded-b h-48 sm:h-72 overflow-auto zind70" x-on:click.away="searchmodal = false" @scroll.window.throttle="searchmodal = false">
        <div class="flex flex-col bg-white px-1 w-60 sm:w-80 text-center text-sm">
            <div class="flex flex-col mt-2 text-left">
                <?php if($search_news): ?>
                    <!-- Loker -->
                    <?php $__currentLoopData = $search_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div onclick="window.open(`<?php echo e(url('/posts/'.$search_data->id)); ?>`, '_self')" class="flex flex-row px-1 py-2 border-b border-solid border-gray-200 hover:bg-gray-200 cursor-pointer">
                        <div class="mr-2 w-1/4">
                            <?php if(count($search_data->images) > 0): ?>
                                <?php $__currentLoopData = $search_data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->first): ?>
                                        <img src="<?php echo e(url($images->url)); ?>" alt="" class="w-10 h-10 m-auto rounded-3xl border border-solid object-contain">
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <div class="w-10 h-10 m-auto px-3 py-2 rounded-3xl border border-solid">
                                <i class="fa-solid fa-magnifying-glass my-auto text-center"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="my-auto w-3/4">
                            <p><?php echo e($search_data->title); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-row px-1 py-2 my-4 border-gray-200 hover:bg-gray-200 cursor-pointer" onclick="getUrl()">
                        <p class="mx-auto my-auto text-blue-700">Lihat Semua</p>
                    </div>
                <?php else: ?>
                    <p>Data tidak ditemukan!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    function getUrl(){
        // alert($('#searchbox').val());
        if(`<?php echo e(request()->routeIs('cari')); ?>`){
            window.livewire.emit('searchData', $('#searchbox').val());
        }else{
            window.open(`<?php echo e(url('cari')); ?>/`+$('#searchbox').val(), '_self');
        }

    }
</script><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/search/nav-search.blade.php ENDPATH**/ ?>