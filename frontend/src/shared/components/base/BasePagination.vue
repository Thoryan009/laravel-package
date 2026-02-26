<template>
  <div class="flex justify-between items-center p-4">
    <!-- Showing records -->
    <div>
      <p>Showing {{ showing }} records of {{ total }}</p>
    </div>

    <!-- Pagination buttons -->
    <div class="flex gap-1">
      <button
        v-for="(link, index) in links"
        :key="index"
        @click="handleLinkClick(link)"
        :disabled="!link?.url || link?.active"
        :class="[
          'px-3 py-1 rounded border text-sm transition-colors',
          link?.active
            ? 'bg-blue-600 text-white border-blue-600 cursor-default'
            : link?.url
            ? 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 cursor-pointer'
            : 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed'
        ]"
        v-html="link?.label"
      />
    </div>

    <!-- Per page -->
    <div class="flex items-center gap-2">
      <label for="perPage">Per Page</label>
      <select
        id="perPage"
        class="border-gray-700 rounded-md shadow-sm px-3 py-1"
        :value="perPage"
        @change="changePerPage"
      >
        <option v-for="size in perPageOptions" :key="size" :value="size">{{ size }}</option>
      </select>
    </div>
  </div>
</template>

<script setup>
defineProps({
  total: Number,
  showing: Number,
  links: {
    type: Array,
    required: true,
  },
  perPage: Number,
  perPageOptions: {
    type: Array,
    default: () => [10, 25, 50, 100],
  },
})

const emit = defineEmits(['update:page', 'update:perPage'])

function handleLinkClick(link) {
  if (!link?.url || link?.active) return

  const page = extractPageNumber(link.url)
  if (page) {
    emit('update:page', page)
  }
}

function extractPageNumber(url) {
  try {
    const parsed = new URL(url)
    return Number(parsed.searchParams.get('page'))
  } catch {
    return null
  }
}

function changePerPage(event) {
  emit('update:perPage', Number(event.target.value))
}
</script>
