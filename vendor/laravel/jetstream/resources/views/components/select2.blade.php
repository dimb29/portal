

<div wire:ignore x-data="{ model: @entangle($attributes->wire('model')) }" x-init="function () {
  if('{{$attributes['ads']}}' == 'tag_it'){
    this.select2 = $(this.$refs.select).select2({tags: true});
  }else{
    this.select2 = $(this.$refs.select).select2();
  };
  this.select2.on('select2:select', (event) => {
    if (event.target.hasAttribute('multiple')){
      this.model = Array.from(event.target.options).filter(option => option.selected).map(option => option.value);
    }else{
      this.model = event.target.value;
    }
  });
  this.select2.on('select2:unselect', (event) => {
    if (event.target.hasAttribute('multiple')){
      this.model = Array.from(event.target.options).filter(option => option.selected).map(option => option.value);
    }else{
      this.model = event.target.value;
    }
  });
  this.$watch('model', (value) => {
    this.select2.val(value).trigger('change');
  });
}
">
  <select x-ref="select" {{ $attributes }}>
        {{ $slot }}
  </select>
</div>