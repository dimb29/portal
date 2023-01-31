<style>
    .select2-container{
        width:100%;
        height:50px;
    }
    .select2-selection{
        height: 145px;
        border: 1px solid #f8fafc;
        padding: 3px;
        box-shadow: 1px 1px 2px 1px #e2e8f0;
    }
    .selection{
    }
</style>
<div class="fixed mt-16 z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden 
        shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" wire:model="mytitle" name="mytitle" id="mytitle" 
                                class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div wire:ignore class="mb-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="content" wire:model="content" x-data 
                                x-init="
                                    CKEDITOR.replace('content');
                                    CKEDITOR.instances.content.on('change', function() {
                                        $dispatch('input', this.getData());
                                    });"></textarea>
                        </div>

                        <div class="mb-4">
                            <div class="flex flex-row">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <div class="flex">
                                    <label for="photos"
                                        class="block text-gray-700 text-sm font-bold mb-2">Header - ( Rekomendasi Ukuran : Ratio 2,5:1 / 25x10cm )</label>
                                    
                                    <div x-show="isUploading" class="px-2">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                <input type="file" multiple name="photos" id="photos"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model="photos">
                                <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <div class="flex flex-row">
                            <div class="w-1/2 mr-1 mb-4" x-data="{idloc:null,nameloc:null,open:false}">
                                <label for="locinput" class="block text-gray-700 text-sm font-bold mb-2">Lokasi:</label>
                                <div @click="open=true" class="shadow appearance-none w-full whitespace overflow-y-auto scrollbar scrollbar-gray h-12 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    <div wire:ignore>
                                        <div id="wrapper-box"class="flex flex-wrap max-w-xl">
                                            <!-- sad -->
                                            <?php if($this->location_regency != null): ?>
                                            <?php $__currentLoopData = $this->location_regency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='<?php echo e($location->name); ?>'>
                                                <span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>
                                                    <a href="javascript:void(0);" data-id="<?php echo e($location->id); ?>" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>
                                                    <span class="text-md my-1 mx-1">
                                                        <?php echo e($location->name); ?>

                                                    </span>
                                                </span>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <?php if($this->location_district != null): ?>
                                            <?php $__currentLoopData = $this->location_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='<?php echo e($location->name); ?>'>
                                                <span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>
                                                    <a href="javascript:void(0);" data-id="<?php echo e($location->id); ?>" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>
                                                    <span class="text-md my-1 mx-1">
                                                        <?php echo e($location->name); ?>

                                                    </span>
                                                </span>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <select hidden name="multiloc" id="multiloc" multiple>
                                            <?php if($this->location_regency != null): ?>
                                                <?php $__currentLoopData = $this->location_regency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option selected data-id='<?php echo e($location->id); ?>' value='<?php echo e($location->name); ?>'><?php echo e($location->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <?php if($this->location_district != null): ?>
                                                <?php $__currentLoopData = $this->location_district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option selected data-id='<?php echo e($location->id); ?>' value='<?php echo e($location->name); ?>'><?php echo e($location->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="absolute w-96 bg-white rounded-b-lg shadow z-10 p-2 max-h-48 overflow-auto" x-show="open" x-on:click.away="open = false">
                                    <input type="text" @keyup="$wire.locationSearch()" wire:model="inloc" id="inloc" name="inloc" placeholder="cari lokasi"
                                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 mb-2 rounded leading-tight focus:outline-none focus:shadow-outline">
                                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php if($this->listloc): ?>
                                    <?php $__currentLoopData = $this->listloc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listloc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="cursor-pointer hover:bg-gray-300 focus:bg-gray-500">
                                            <?php if($loop->last): ?>
                                                <p @click="open=false" onclick="addLocation('<?php echo e(ucwords(strtolower($listloc->name))); ?>')" class="py-2"><?php echo e(ucwords(strtolower($listloc->name))); ?></p>
                                            <?php else: ?>
                                                <p @click="open=false" onclick="addLocation('<?php echo e(ucwords(strtolower($listloc->name))); ?>')" class="py-2"><?php echo e(ucwords(strtolower($listloc->name))); ?></p><hr>
                                                <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex row sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex ml-2 mr-2 rounded-md shadow-sm sm:w-auto">
                        <!-- <button wire:click="store()" type="button" -->
                        <button wire:click="store" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                    </span>
                    <span class="flex rounded-md shadow-sm sm:w-auto">
                        <button wire:click="closeModal()" data-modal-toggle="modal-create" type="button"
                            class="inline-flex items-center px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            Cancel
                        </button>
                    </span>
            </form>
        </div>

    </div>
</div>
</div>

<script>
CKEDITOR.replace( 'content' );
    $('#select2-multitle-results').hide()

    //MultiTitle
    
    //Once remove button is clicked
    $('#wrapper-box').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('span').parent('div').remove(); //Remove field html
        var selId = $(this).attr('data-id');
        console.log(selId);
        $("option[data-id='" + selId + "']").remove(); 
        x--; //Decrement field counter
        var multval = $('#multitle').val();
        window.livewire.emit('multiTitle',multval)
    });
$(document).ready(function(){
    var route = "<?php echo e(url('dashboard/autocomplete-search')); ?>";
    $('#search-loc').typeahead({
        source: function (query, process) {
            var dataquery = query;
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
})
</script><?php /**PATH C:\Users\Masgasso\Documents\project\news\resources\views/livewire/posts/create.blade.php ENDPATH**/ ?>