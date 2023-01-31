

<div wire:ignore x-data="{ model: <?php if ((object) ($attributes->wire('model')) instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e($attributes->wire('model')->value()); ?>')<?php echo e($attributes->wire('model')->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e($attributes->wire('model')); ?>')<?php endif; ?> }" x-init="function () {
  if('<?php echo e($attributes['ads']); ?>' == 'tags'){
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
  <select x-ref="select" <?php echo e($attributes); ?>>
        <?php echo e($slot); ?>

  </select>
</div><?php /**PATH C:\Users\Masgasso\Documents\project\news\vendor\laravel\jetstream\src/../resources/views/components/select2.blade.php ENDPATH**/ ?>