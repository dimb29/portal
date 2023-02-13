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
<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
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
                    <div class="mb-4">
                        <label for="name">Nama Lengkap :</label>
                        <x-jet-input type="text" wire:model="name" name="name" id="name" 
                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="email">Email :</label>
                        <x-jet-input type="email" wire:model="email" name="email" id="email" 
                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="user_type">Type User :</label>
                        <select wire:model="user_type" name="user_type" id="user_type" 
                            class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih type</option>
                            <option value="administr">Admin</option>
                            <option value="editrx">Editor</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="password">Password :</label>
                        <x-jet-input type="password" wire:model="password" name="password" id="password" 
                        class="shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
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

<script>
// $(document).ready(function() {
//   $('#tags_id').on('keydown', '.select2-search__field', function(e) {
//     if (e.keyCode === 32) {
//       e.preventDefault();
//       return false;
//     }
//   });
// });
</script>
<script>
$('#select2-multitle-results').hide()
$(document).ready(function(){
    var route = "{{ url('dashboard/autocomplete-search') }}";
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
</script>