<template>
  <!-- Show only if items exist -->
  <div v-if="items && items.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div v-for="item in items" :key="item.key" class="bg-white rounded-xl shadow p-5">
      <!-- Label -->
      <p class="text-sm text-gray-500">
        {{ item.label }}
      </p>

      <!-- Value -->
      <p class="text-2xl font-bold text-gray-800 mt-2">
        {{ formatValue(item.value) }}
      </p>
    </div>
  </div>

  <!-- Optional empty state -->
  <div v-else class="text-center text-gray-400 py-6">
    No data available
  </div>
</template>

<script setup>
const props = defineProps({
  items: {
    type: Array,
    required: true, // ✅ must come from parent
  },
})

/* Safe formatter */
const formatValue = (val) => {
  if (val === null || val === undefined) return 0
  return Number(val).toLocaleString()
}
</script>
