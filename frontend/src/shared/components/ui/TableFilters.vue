<template>
  <div class="flex gap-2 items-end">

    <!-- FROM DATE -->
    <div class="flex flex-col">
      <label class="text-gray-800 text-[15px]">
        {{ fromDateLabel }}
      </label>

      <input type="date" v-model="filters.from_date" class="border border-gray-300 rounded-md px-3 py-2" />
    </div>

    <!-- TO DATE -->
    <div class="flex flex-col">
      <label class="text-gray-800 text-[15px]">
        {{ toDateLabel }}
      </label>

      <input type="date" v-model="filters.to_date" class="border border-gray-300 rounded-md px-3 py-2" />
    </div>

    <!-- SEARCH -->
    <div v-if="showSearch" class="flex flex-col">
      <label class="text-gray-800 text-[15px]">Search</label>
      <BaseInput v-model="filters.searchQuery" placeholder="Search..." />
    </div>

    <!-- EXTRA FILTERS (MODULE SPECIFIC) -->
    <slot />

    <!-- RESET -->
    <BaseButton v-if="hasActiveFilters" class="bg-gray-600 text-white hover:bg-gray-700" @click="$emit('reset')">Reset
    </BaseButton>
  </div>
</template>

<script setup>
defineProps({
  filters: Object,
  hasActiveFilters: Boolean,

  showSearch: {
    type: Boolean,
    default: true,
  },

  fromDateLabel: {
    type: String,
    default: 'From Date',
  },

  toDateLabel: {
    type: String,
    default: 'To Date',
  },
})

defineEmits(['reset'])
</script>
