@props([
    'error' => null
])<div wire:ignore
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-on:change="value = $event.target.value"
    x-init="flatpickr($refs.datetimewidget, {wrap: true, enableTime: true, dateFormat: 'Y-m-d H:i:S'});"
    x-ref="datetimewidget"
>
    <div class="flex align-middle align-content-center">
        <input id="{{$attributes['id']}}"
            x-ref="datetime"
            type="text"
            id="datetime"
            x-bind:value="value" 
            data-input
            placeholder="{{$attributes['placeholder']}}"
            autocomplete="off"
            class="@if($error) focus:ring-danger-500 focus:border-danger-500 border-danger-500 text-danger-500 pr-10 @else focus:ring-primary-500 focus:border-primary-500 @endif {{$attributes['class']}}"
        {{ $attributes->whereDoesntStartWith('wire:model') }} 

        >
        
        <a
            class="h-10 w-10 input-button cursor-pointer rounded-r-md bg-transparent border-gray-300 border-t border-b border-r"
            title="clear" data-clear
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mt-1 ml-1" viewBox="0 0 20 20" fill="#c53030">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </a>
    </div>

</div>
