<template>
  <div>
    <input
      :id="id"
      :type="type"
      :placeholder="placeholder"
      :step="step"
      :value="modelValue"
      :disabled="disabled"
      :readonly="readonly"
      :required="required"
      @input="$emit('update:modelValue', $event.target.value)"
      :class="[
    className,
    disabled && 'opacity-50 cursor-not-allowed',
    readonly && 'bg-gray-100 cursor-not-allowed'
  ]"
    />
  </div>
</template>

<script setup>
defineProps({
  modelValue: {
    type: [String, Number],
    default: '',
  },
  type: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: '',
  },
  id: {
    type: String,
    default: '',
  },
  step: {
    type: String,
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  required: {
    type: Boolean,
    default: false,
  },
  className: {
    type: String,
    default:
      'w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500',
  },
  readonly: {
    type: Boolean,
    default: false,
  },
})
defineEmits(['update:modelValue'])
</script>
