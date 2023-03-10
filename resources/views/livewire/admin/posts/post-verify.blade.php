<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden 
        shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" @click.away="$wire.closeVerify()">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <label for="verify">Pilih Tindakan :</label>
                        <select name="verify" id="verify" wire:click="changeType($event.target.value)"
                            class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih tindakan</option>
                            @if($types)
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name_tag}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="inline-flex">
                        <input type="checkbox" wire:model="descOn" wire:click="isDefault($event.target.value)" class="mr-2">
                        gunakan default?
                    </div>
                    @if($descOn)
                    <div>
                        <label for="desc">Keterangan :</label>
                        <div class="mb-4 shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                            {!! $desc !!}
                        </div>
                    </div>
                    @else
                    <div class="mb-4">
                        <div wire:ignore>
                            <label for="desc">Keterangan :</label>
                            <textarea name="desc" id="desc" wire:model="desc" cols="30" rows="10"
                                class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" x-data 
                                x-init="
                                ClassicEditor
                                .create( $refs.editordescription)
                                .then(function(editor){
                                    
                                    editor.model.document.on('change:data', () => {
                                        @this.set('desc', editor.getData())
                                        
                                    })
                                    
                                })
                                .catch( error => {
                                    console.error( error );
                                } );" x-ref="editordescription"></textarea>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex flex-row sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex ml-2 mr-2 rounded-md shadow-sm sm:w-auto">
                        <!-- <button wire:click="store()" type="button" -->
                        <button wire:click="verifyStore" type="button"
                            class=" inline-flex items-center px-6 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                    </span>
                    <span class="flex rounded-md shadow-sm sm:w-auto">
                        <button wire:click="closeVerify()" data-modal-toggle="modal-create" type="button"
                            class="inline-flex items-center px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            Cancel
                        </button>
                    </span>
            </form>
        </div>

    </div>
</div>
</div>