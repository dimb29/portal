<div class="w-full p-4" x-data="{showComment:false}">
    <div class="flex flex-row p-2">
        <i wire:click="<?php if(count($post->like) > 0): ?> unLikeIt([<?php echo e($post->id); ?>]) <?php else: ?> likeIt([<?php echo e($post->id); ?>]) <?php endif; ?>" 
        class="<?php if(count($post->like) > 0): ?> fa-solid <?php else: ?> fa-regular <?php endif; ?> fa-thumbs-up mx-1 my-auto cursor-pointer"></i>
        <p wire:click="<?php if(count($post->like) > 0): ?> unLikeIt([<?php echo e($post->id); ?>]) <?php else: ?> likeIt([<?php echo e($post->id); ?>]) <?php endif; ?>" 
            class="mr-2 my-auto text-gray-500 text-sm cursor-pointer">
            <?php if(count($post->like) > 0): ?>
                <?php echo e(count($post->like)); ?> 
            <?php endif; ?>
            Suka
        </p>
        <i class="fa-regular fa-comment-dots mx-1 my-auto text-base cursor-pointer" @click="showComment =! showComment"></i> 
        <p class="mr-2 my-auto text-gray-500 text-sm cursor-pointer" @click="showComment =! showComment">Komentar</p>
    </div>
    <div class="mb-4 flex flex-row py-2 pl-4 pr-6 rounded-3xl shadow border border-solid" x-show="showComment">
        <input wire:model="komen" type="text" class="w-full focus:outline-none border-none" placeholder="Tambah Komentar">
        <i wire:click="sendComment([<?php echo e($post->id); ?>])" class="fa-solid fa-circle-chevron-right text-lg my-auto mx-auto cursor-pointer"></i>
    </div>
    <?php if($comments): ?>
    <hr class="my-2">
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="flex flex-row mt-4" x-data="{showComment<?php echo e($comment->id); ?>:false, commentChild<?php echo e($comment->id); ?>:false}">
        <div class="mr-2 min-w-20">
            <?php if($comment->author_type == 'user'): ?>
                <?php if($comment->author->profile_photo_url): ?>
                <img src="<?php echo e(url($comment->author->profile_photo_url)); ?>" alt="" class="w-14 rounded-3xl border border-solid">
                <?php else: ?>
                <img src="<?php echo e(url('storage/photos/default-logo.jpg')); ?>" alt="" class="w-14 rounded-3xl border border-solid">
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="flex flex-col w-full">
            <div class="content border border-solid rounded shadow-lg p-2">
                <div class="flex flex-row">
                    <?php if($comment->author_type == 'user'): ?>
                    <p class="font-bold text-sm mr-1"><?php echo e($comment->author->name); ?></p>
                    <p class="my-auto text-xs text-gray-500 italic">pengguna</p>
                    <?php endif; ?>
                </div>
                <hr class="my-2">
                <div class="text-xs">
                    <?php echo $comment->comment; ?>

                </div>
                <hr class="my-2">
                <div class="flex flex-row p-2">
                    <i wire:click="<?php if(count($comment->like) > 0): ?> unLikeIt([<?php echo e($post->id); ?>, <?php echo e($comment->id); ?>]) <?php else: ?> likeIt([<?php echo e($post->id); ?>, <?php echo e($comment->id); ?>]) <?php endif; ?>" 
                    class="<?php if(count($comment->like) > 0): ?> fa-solid <?php else: ?> fa-regular <?php endif; ?> fa-thumbs-up text-sm mx-1 my-auto cursor-pointer"></i>
                    <p wire:click="<?php if(count($comment->like) > 0): ?> unLikeIt([<?php echo e($post->id); ?>, <?php echo e($comment->id); ?>]) <?php else: ?> likeIt([<?php echo e($post->id); ?>, <?php echo e($comment->id); ?>]) <?php endif; ?>" 
                        class="mr-2 my-auto text-gray-500 text-xs cursor-pointer">
                        <?php if(count($comment->like) > 0): ?>
                            <?php echo e(count($comment->like)); ?> 
                        <?php endif; ?>
                        Suka
                    </p>
                    <i class="fa-regular fa-comment-dots mx-1 my-auto text-sm cursor-pointer" @click="showComment<?php echo e($comment->id); ?> =! showComment<?php echo e($comment->id); ?>"></i>
                    <p class="mr-2 my-auto text-gray-500 cursor-pointer text-xs" @click="showComment<?php echo e($comment->id); ?> =! showComment<?php echo e($comment->id); ?>">Balas</p>
                    <?php if(count($comment->child) != null): ?>
                        <p class="ml-2 my-auto text-gray-500 cursor-pointer text-xs" 
                            @click="commentChild<?php echo e($comment->id); ?> =! commentChild<?php echo e($comment->id); ?>">
                            Tampilkan 
                            <?php if(count($comment->child) != null): ?>
                                <?php echo e(count($comment->child)); ?>

                            <?php endif; ?>
                            Jawaban
                        </p>
                        <template x-if="commentChild<?php echo e($comment->id); ?>">
                            <i class="fa-sharp fa-solid fa-caret-up text-sm mx-1 my-auto cursor-pointer" @click="commentChild<?php echo e($comment->id); ?> =! commentChild<?php echo e($comment->id); ?>"></i>
                        </template>
                        <template x-if="!commentChild<?php echo e($comment->id); ?>">
                            <i class="fa-sharp fa-solid fa-caret-down text-sm mx-1 my-auto cursor-pointer" @click="commentChild<?php echo e($comment->id); ?> =! commentChild<?php echo e($comment->id); ?>"></i>
                        </template>
                    <?php endif; ?>
                </div>
                <div class="mb-4 flex flex-row py-2 pl-4 pr-6 rounded-3xl shadow border border-solid" x-show="showComment<?php echo e($comment->id); ?>">
                    <input wire:model="komen" type="text" class="w-full focus:outline-none border-none" placeholder="Tambah Komentar">
                    <i wire:click="sendComment([<?php echo e($post->id); ?>,<?php echo e($comment->id); ?>])" class="fa-solid fa-circle-chevron-right text-lg my-auto cursor-pointer"></i>
                </div>
            </div>
            <?php if(count($comment->child) != null): ?>
                <div x-show="commentChild<?php echo e($comment->id); ?>">
                    <?php $__currentLoopData = $comment->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex flex-row mt-2" x-data="{showComment<?php echo e($child->id); ?>:false}">
                            <div class="mr-2 min-w-20">
                            <?php if($child->author_type == 'user'): ?>
                                <?php if($child->author->profile_photo_url): ?>
                                <img src="<?php echo e(url($child->author->profile_photo_url)); ?>" alt="" class="w-14 rounded-3xl border border-solid">
                                <?php else: ?>
                                <img src="<?php echo e(url('storage/photos/default-logo.jpg')); ?>" alt="" class="w-14 rounded-3xl border border-solid">
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                            <div class="flex flex-col w-full">
                                <div class="content border border-solid rounded shadow-lg p-2">
                                    <div class="flex flex-row">
                                        <?php if($child->author_type == 'user'): ?>
                                        <p class="font-bold text-sm mr-0.5 sm:mr-1 truncate"><?php echo e($child->author->name); ?></p>
                                        <p class="my-auto text-xs text-gray-500 italic hidden sm:flex">pengguna</p>
                                        <?php endif; ?>
                                        <i class="fa-solid fa-caret-right mx-2 my-auto text-xs"></i>
                                        <?php
                                            if($child->parent2_id):
                                                $isparent = 'parent2';
                                                $parent_id = $child->parent2_id;
                                            else:
                                                $isparent = 'parent';
                                                $parent_id = $child->parent_id;
                                            endif;
                                            $parent_type = $child->$isparent->author_type;
                                        ?>
                                        <?php if($parent_type == 'user'): ?>
                                        <p class="font-bold text-sm mr-0.5 sm:ml-1 truncate"><?php echo e($child->$isparent->author->name); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <hr class="my-2">
                                    <div class="text-xs">
                                        <?php echo $child->comment; ?>

                                    </div>
                                    <hr class="my-2">
                                    <div class="flex flex-row p-2">
                                        <i wire:click="<?php if(count($child->like) > 0): ?> unLikeIt([<?php echo e($post->id); ?>, <?php echo e($child->id); ?>]) <?php else: ?> likeIt([<?php echo e($post->id); ?>, <?php echo e($child->id); ?>]) <?php endif; ?>" 
                                        class="<?php if(count($child->like) > 0): ?> fa-solid <?php else: ?> fa-regular <?php endif; ?> fa-thumbs-up text-sm mx-1 my-auto cursor-pointer"></i>
                                        <p wire:click="<?php if(count($child->like) > 0): ?> unLikeIt([<?php echo e($post->id); ?>, <?php echo e($child->id); ?>]) <?php else: ?> likeIt([<?php echo e($post->id); ?>, <?php echo e($child->id); ?>]) <?php endif; ?>" 
                                            class="mr-2 my-auto text-gray-500 text-xs cursor-pointer">
                                            <?php if(count($child->like) > 0): ?>
                                                <?php echo e(count($child->like)); ?> 
                                            <?php endif; ?>
                                            Suka
                                        </p>
                                        <i class="fa-regular fa-comment-dots text-sm mx-1 my-auto cursor-pointer" @click="showComment<?php echo e($child->id); ?> =! showComment<?php echo e($child->id); ?>"></i>
                                        <p class="mr-2 my-auto text-gray-500 cursor-pointer text-xs" @click="showComment<?php echo e($child->id); ?> =! showComment<?php echo e($child->id); ?>">Balas  </p>
                                    </div>
                                    <div class="mb-4 flex flex-row py-2 pl-2 pr-4 rounded-3xl shadow border border-solid" x-show="showComment<?php echo e($child->id); ?>">
                                        <input wire:model="komen" type="text" class="w-full focus:outline-none text-xs border-none" placeholder="Tambah Komentar">
                                        <i wire:click="sendComment([<?php echo e($post->id); ?>, <?php echo e($comment->id); ?>, <?php echo e($child->id); ?>])" class="fa-solid fa-circle-chevron-right text-lg my-auto cursor-pointer"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/comment/comment.blade.php ENDPATH**/ ?>