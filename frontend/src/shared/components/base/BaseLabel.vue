<template>
  <label :for="forId" class="block text-gray-900 mb-1" :class="className" v-bind="$attrs">
    <slot />
  </label>
</template>

<script setup>
defineProps({
  forId: { type: String, default: null },
  className: { type: String, default: 'text-[16px]' },
})
</script>
