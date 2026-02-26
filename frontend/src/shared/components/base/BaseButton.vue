<template>
  <button
    :type="type"
    class="w-full rounded-md px-4 py-2 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 sm:w-auto"
    :class="[
    className,
    disabled && 'opacity-50 cursor-not-allowed!'
  ]"
  >
    <slot />
  </button>
</template>

<script setup>
defineProps({
  type: {
    type: String,
    default: 'button',
  },
  className: {
    type: String,
    default: 'bg-blue-600 hover:bg-blue-700 text-white cursor-pointer',
  },
   disabled: {
    type: Boolean,
    default: false,
  },
})
</script>
