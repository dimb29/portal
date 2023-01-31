<?php if($populers): ?>
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b border-solid bg-blue-500 text-sm sm:text-lg text-white text-center">Terpopuler</p>
        <?php $__currentLoopData = $populers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $populer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex flex-row">
            <div class="bg-blue-500 text-white">
                <p class="my-auto mx-auto align-middle text-lg sm:text-xl font-bold"><?php echo e($key+1); ?></p>
            </div>
            <p class="py-1 px-1 my-auto line-clamp-2 text-xs sm:text-base"><?php echo e($populer->title); ?></p>
        </div>
        <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php if($comments): ?>
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b-4 border-solid border-b-blue-500  text-sm sm:text-lg text-center">Komentar Terhangat</p>
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex flex-row py-1 px-1">
            <?php if($comment->author->profile_photo_url): ?>
            <img src="<?php echo e(url($comment->author->profile_photo_url)); ?>" alt="" class="my-auto w-10 sm:w-14 h-10 sm:h-14 rounded-3xl border border-solid">
            <?php else: ?>
            <img src="#" alt="" class="my-auto w-14 h-14 rounded-3xl border border-solid">
            <?php endif; ?>
            <div class="px-1">
                <p class="font-bold truncate text-sm sm:text-base"><?php echo e($comment->author->name); ?></p>
                <p class="line-clamp-1 sm:line-clamp-2 text-xs sm:text-sm"><?php echo e($comment->comment); ?></p>
            </div>
        </div>
        <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php if(count($choices) > 0): ?>
    <div class="border border-b shadow-sm mb-4">
        <p class="py-2 px-1 border-b border-solid bg-blue-500 text-sm sm:text-lg text-white text-center">Berita Pilihan</p>
        <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex flex-row py-1 px-1">
            <?php if($choice->images): ?>
            <?php $__currentLoopData = $choice->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->first): ?>
            <img src="<?php echo e(url($img->url)); ?>" alt="" class="my-auto w-10 sm:w-14 h-10 sm:h-14 rounded-3xl border border-solid">
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <img src="#" alt="" class="my-auto w-14 h-14 rounded-3xl border border-solid">
            <?php endif; ?>
            <p class="py-1 px-1 my-auto line-clamp-2 text-xs sm:text-base"><?php echo e($choice->title); ?></p>
        </div>
        <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/layouts/right-menu.blade.php ENDPATH**/ ?>