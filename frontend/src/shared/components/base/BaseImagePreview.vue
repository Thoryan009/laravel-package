<template>
  <div
    v-if="src"
    class="relative mt-5 inline-block"
    :class="className"
    :style="{
      width: width,
      height: height
    }"
  >
    <!-- Close button -->
    <button
      v-if="showCancel"
      class="absolute -top-2 -right-2 w-6 h-6 bg-slate-900 rounded-full p-1
             hover:bg-slate-700 cursor-pointer flex justify-center items-center transition text-slate-50"
      @click="cancelImage"
      type="button"
    >
      <i class="fa fa-times"></i>
    </button>

    <!-- Image -->
    <img
      :src="src"
      :alt="alt"
      class=" object-cover border border-gray-300"
      :class="className"
    />
  </div>
</template>

<script setup>

defineProps({
  src: {
    type: String,
    default: null
  },
  width: {
    type: String,
    default: "200px"
  },
  height: {
    type: String,
    default: "150px"
  },
  alt: {
    type: String,
    default: "Preview"
  },
  className: {
    type: String,
    default: 'w-[400px] h-[220px] rounded'
  },
  showCancel: {
    type: Boolean,
    default: true
  }
});

const emit = defineEmits(['cancelImage'])

const cancelImage = () => {
  emit('cancelImage')
}

</script>
