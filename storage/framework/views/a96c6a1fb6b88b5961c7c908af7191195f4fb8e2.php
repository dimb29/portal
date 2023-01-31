 <?php $__env->slot('header', null, []); ?> 
    <div class="bg-white">
        <div class="hidden sm:flex max-w-7xl mx-auto">
            <img class="object-contain h-full w-full" src="<?php echo e(url('storage/photos/banner.jpg')); ?>">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-56 w-full" src="<?php echo e(url('storage/photos/hp.jpg')); ?>">
        </div>
    </div>
 <?php $__env->endSlot(); ?>

 <?php $__env->slot('footer', null, []); ?> 
 <?php $__env->endSlot(); ?>

<div class="py-12 bg-yellow bg-fixed ..." >

    <div class="flex flex-col sm:flex-row">
        <div class="w-full sm:w-3/4 sm:pl-8 sm:pr-4">
            <div class="mt-4 sm:mt-8">
                <div class="flex flex-row items-end">
                    <p class="border-b-4 border-solid border-b-blue-500 text-sm sm:text-xl">Hasil Pencarian "<?php echo e($search); ?>"</p>
                </div>
                <div class="flex flex-col mt-4">
                    <?php if($allposts): ?>
                    <?php $__currentLoopData = $allposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-row item-center h-14 sm:h-40 my-1 hover:text-blue-500 cursor-pointer">
                        <?php if($allpost->images): ?>
                        <?php $__currentLoopData = $allpost->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(url($image->url)); ?>" alt="photo-news"
                        class="w-1/4 h-full object-cover border border-solid">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <img src="<?php echo e(url('storage/photos/post/N1gXTbqKoYiXrmVYBqQCpjixX48FYxUB5tkJgqcP.jpg')); ?>" alt="photo-news"
                        class="w-1/4 h-full object-cover border border-solid">
                        <?php endif; ?>
                        <div class="flex flex-col w-3/4 ml-4 my-auto">
                            <p class="text-sm sm:text-xl line-clamp-1 sm:line-clamp-2"><?php echo e($allpost->title); ?></p>
                            <p class="text-xs sm:text-base text-gray-500"><?php echo e($allpost->created_at->format('d F Y')); ?></p>
                        </div>
                    </div>
                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/4 sm:pl-4 sm:pr-8 flex flex-col">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('layouts.right-menu', [])->html();
} elseif ($_instance->childHasBeenRendered('l3064527164-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3064527164-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3064527164-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3064527164-0');
} else {
    $response = \Livewire\Livewire::mount('layouts.right-menu', []);
    $html = $response->html();
    $_instance->logRenderedChild('l3064527164-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
</div><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/posts/berita.blade.php ENDPATH**/ ?>