<style>
    .select2-container{
        width:100%;
        height:50px;
    }
    .select2-selection{
        height:45px;
        border: 1px solid #f8fafc;
        padding: 3px;
        box-shadow: 1px 1px 2px 1px #e2e8f0;
        overflow:hidden;
        overflow-y:auto;
    }
    .selection{
    }
</style>
<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400" x-data="{open:false}">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden 
        shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" @click.away="$wire.closeModal()">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <p class="text-lg sm:text-xl font-bold mb-4">{{$title}}</p>
                    <div class="flex flex-row">
                        <p class="text-gray-500">Dikirim oleh :</p>
                        <p class="font-bold pl-1">{{$from->name}}</p>
                    </div>
                    <div class="flex flex-row">
                        <p class="text-gray-500">Diterima oleh :</p>
                        <p class="font-bold pl-1">{{$users->name}}</p>
                    </div>
                    <div class="my-2 rounded border border-solid py-2 px-3">{!! $desc !!}</div>
                </div>

                <div class="flex flex-row sm:px-6 sm:flex sm:flex-row-reverse">
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