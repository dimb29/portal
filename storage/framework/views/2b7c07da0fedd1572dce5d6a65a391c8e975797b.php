 <?php $__env->slot('header', null, []); ?> 
    <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Post
    </h2> -->
 <?php $__env->endSlot(); ?>

 <?php $__env->slot('footer', null, []); ?> 
 <?php $__env->endSlot(); ?>
<div class="pt-0 sm:pt-12">
    <div class="flex flex-col sm:flex-row">
        <div class="w-full sm:w-3/4 sm:pl-8 sm:pr-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <?php if(session()->has('message')): ?>
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm"><?php echo e(session('message')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="flex-auto m-1">
                    <div class="grid grid-flow-col">
                        <div class="py-4">
                        <?php if(count($post->images) != 0): ?>
                        <?php $__currentLoopData = $post['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img class="h-40 sm:h-96" src="<?php echo e(url($image->url)); ?>" alt="<?php echo e($image->description); ?>" width="100%">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <img class="h-40 sm:h-72" width="100%" src="<?php echo e(url('storage/photos/default_jobs.png')); ?>" alt="this is default">
                        <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <?php if($post->author->profile_photo_path != null): ?>
                            <img class="h-15 sm:h-20 w-15 sm:w-20 rounded-lg object-contain my-4" src="<?php echo e($post->author->profile_photo_url); ?>" alt="<?php echo e($post->author->first_name . ' ' . $post->author->last_name); ?>" />
                        <?php else: ?>
                            <img class="h-15 sm:h-20 w-15 sm:w-20 rounded-lg object-contain" src="<?php echo e(url('storage/photos/default-logo.jpg')); ?>" alt="<?php echo e($post->author->first_name . ' ' . $post->author->last_name); ?>" />
                        <?php endif; ?>
                    </div>

                    <div class="hidden sm:flex flex-row" id="myHeader">

                        <div class="marginstick">
                        
                            <div class="font-bold text-xl mb-2">
                                <?php echo e($post->title); ?>

                            </div>
                            <h5 class="text-lg font-medium">
                                <?php
                                $regens = $post->regency;
                                $dists = $post->district;
                                for($i=0;$i < count($regens);$i++){
                                if($i+1 == count($regens)){
                                    echo ucwords(strtolower($regens[$i]->name));
                                }else{
                                    echo ucwords(strtolower($regens[$i]->name.", "));
                                    }
                                }
                                for($i=0;$i < count($dists);$i++){
                                if($i+1 == count($dists)){
                                    echo ucwords(strtolower(", ".$dists[$i]->name));
                                }else{
                                    echo ucwords(strtolower($dists[$i]->name.", "));
                                    }
                                }
                                ?>
                            </h5>
                                <div class="flex flex-col sm:flex-row mb-4 sm:mb-0">
                                    <p>by&nbsp;<span class="italic"><?php echo e($post->author->first_name . ' ' . $post->author->last_name); ?></span></p>
                                    &nbsp;on&nbsp;<?php echo e($post->updated_at->format('F, d Y')); ?>

                                </div>
                            <div id="location" data-id="<?php echo e($post->location_id); ?>"></div>
                        </div>

                    </div>


                    <div class="stickyy flex-col sm:hidden">

                        <div class="fixt">
                        
                            <div class="font-bold text-xl mb-2">
                                <?php echo e($post->title); ?>

                            </div>
                            <h5 class="text-lg font-medium">
                                <?php
                                $regens = $post->regency;
                                for($i=0;$i < count($regens);$i++){
                                if($i+1 == count($regens)){
                                    echo ucwords(strtolower($regens[$i]->name));
                                }else{
                                    echo ucwords(strtolower($regens[$i]->name.", "));
                                    }
                                }
                                ?>
                            </h5>
                                <div class="flex flex-col sm:flex-row mb-4">
                                    <p>by&nbsp;<span class="italic"><?php echo e($post->author->first_name . ' ' . $post->author->last_name); ?></span></p>
                                    &nbsp;on&nbsp;<?php echo e($post->updated_at->format('F, d Y')); ?>

                                </div>
                            <div id="location" data-id="<?php echo e($post->location_id); ?>"></div>
                        </div>
                    </div>
                    
                    <div id="content<?php echo e($post->id); ?>" class="text-gray-700 text-base m-auto mt-10" readonly="readonly" x-data
                        x-init="
                        ClassicEditor
                        .create( $refs.editordescription<?php echo e($post->id); ?>)
                        .then(function(editor){
                            const toolbarElement = editor.ui.view.toolbar.element;
                            toolbarElement.style.display = 'none';
                            editor.enableReadOnlyMode('content<?php echo e($post->id); ?>');
                        })
                        .catch( error => {
                            console.error( error );
                        });" x-ref="editordescription<?php echo e($post->id); ?>">
                        <p><?php echo $post->content; ?></p>
                    </div>
                </div>
            </div>
            <div class="my-6">
                <div class="max-w-7xl mx-auto" id="post-frame">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('comment.comment', ['postId' => $post->id,'post_id' => $post->id])->html();
} elseif ($_instance->childHasBeenRendered('l253561233-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l253561233-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l253561233-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l253561233-0');
} else {
    $response = \Livewire\Livewire::mount('comment.comment', ['postId' => $post->id,'post_id' => $post->id]);
    $html = $response->html();
    $_instance->logRenderedChild('l253561233-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/4 sm:pl-4 sm:pr-8 flex flex-col">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('layouts.right-menu', [])->html();
} elseif ($_instance->childHasBeenRendered('l253561233-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l253561233-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l253561233-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l253561233-1');
} else {
    $response = \Livewire\Livewire::mount('layouts.right-menu', []);
    $html = $response->html();
    $_instance->logRenderedChild('l253561233-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
</div>


<style>
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border: 0;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .then( editor => {
            const toolbarElement = editor.ui.view.toolbar.element;
            toolbarElement.style.display = "none";
            editor.enableReadOnlyMode( '#content' );
        } )
        .catch(error => {
            console.error(error);
        });

function copyLink() {
  var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999); 

  navigator.clipboard.writeText(copyText.value);
  
  alert("Tautan Berhasil Disalin");
}

</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky1");
  } else {
    header.classList.remove("sticky1");
  }
}
</script>


<script>
var stickyOffset = $('.stickyy').offset().top;

$(window).scroll(function(){
  var sticky = $('.stickyy'),
      scroll = $(window).scrollTop();

  if (scroll >= stickyOffset) sticky.addClass('fixme');
  else sticky.removeClass('fixme');
});
</script><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/posts/post.blade.php ENDPATH**/ ?>