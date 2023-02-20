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
                    @if(!$isNotif)
                    <div class="mb-4">
                        <label for="name_tag">Name Tag :</label>
                        <x-jet-input type="text" wire:model="name_tag" name="name_tag" id="name_tag" 
                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    @endif
                    <div class="mb-4">
                        <label for="title">Judul :</label>
                        <x-jet-input type="text" wire:model="title" name="title" id="title" 
                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4" wire:ignore>
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
                    @if($isNotif)
                    <div class="flex flex-row mb-4 gap-4">
                        <div class="w-1/2">
                            <label for="type">Tipe Notif</label>
                            <select name="type" id="type" wire:model="type" 
                                class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Pilih tipe</option>
                                @if($types)
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name_tag}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="w-1/2">
                            <label for="to_user">Tujuan :</label>
                            <div @click="open=true" class="shadow appearance-none w-full whitespace overflow-y-auto h-12 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                <div wire:ignore>
                                    <div id="wrapper-box"class="flex flex-wrap max-w-xl">
                                        <!-- sad -->
                                        @if($this->users != null)
                                        <div class='selection-choice op-"+numb+"-ch mx-1 my-1 max-w-sm w-auto' title='{{$users->name}}'>
                                            <span class='rounded border border-gray-300' style='background-color:#e5e7eb;'>
                                                <a href="javascript:void(0);" data-id="{{$users->id}}" onclick="delUser('{{$users->id}}')" class="remove_button border-r border-gray-300 cursor-pointer text-md text-gray-400 hover:text-gray-700 px-1 my-1 hover:bg-gray-200 focus:bg-gray-100">x</a>
                                                <span class="text-md my-1 mx-1">
                                                    {{$users->name}}
                                                </span>
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <select hidden name="multiuser" id="multiuser" multiple>
                                        @if($this->users != null)
                                            <option selected data-id='{{$users->id}}' value='{{ucwords(strtolower($users->name))}}'>{{ucwords(strtolower($users->name))}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="absolute w-96 bg-white rounded-b-lg shadow z-10 p-2 max-h-48 overflow-auto" x-show="open" x-on:click.away="open = false">
                                <input type="text" @keyup="$wire.usersSearch()" wire:model="inuser" id="inuser" name="inuser"
                                    class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 mb-2 rounded leading-tight focus:outline-none focus:shadow-outline">
                                @error('user') <span class="text-red-500">{{ $message }}</span>@enderror
                                @if($this->listuser)
                                @foreach($this->listuser as $listuser)
                                    <div class="cursor-pointer hover:bg-gray-300 focus:bg-gray-500">
                                        @if($loop->last)
                                            <p @click="open=false" onclick="addUser('{{$listuser->id}}_-_{{ucwords(strtolower($listuser->name))}}')" class="py-2">{{ucwords(strtolower($listuser->name))}}</p>
                                        @else
                                            <p @click="open=false" onclick="addUser('{{$listuser->id}}_-_{{ucwords(strtolower($listuser->name))}}')" class="py-2">{{ucwords(strtolower($listuser->name))}}</p><hr>
                                        @endif
                                    </div>
                                @endforeach
                                @endif
                            </div>
                            <p class="text-gray-500">nb. kosongkan tujuan jika ingin mengirim ke semua user</p>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex flex-row sm:px-6 sm:flex sm:flex-row-reverse">
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