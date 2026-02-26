<template>
  <table class="w-full border border-gray-300">
    <thead>
      <tr class="bg-gray-100">
        <!-- Select All -->
        <th v-if="selectable" class="border border-gray-300 px-3 py-2 text-center">
          <input
            type="checkbox"
            class="cursor-pointer"
            :checked="rows.length && selectedIds.length === rows.length"
            @change="emit('toggleAll', $event.target.checked)"
          />
        </th>
        <th
          v-for="col in columns"
          :key="col.key"
          class="border border-gray-300 px-3 py-2 text-left text-sm font-medium"
        >{{ col.label }}</th>

        <th
          v-if="showActions"
          class="border border-gray-300 px-3 py-2 text-center text-sm font-medium"
        >Actions</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(row, index) in rows" :key="index" class="hover:bg-gray-50">
        <!-- Row Checkbox -->
        <td v-if="selectable" class="border border-gray-300 px-3 py-2 text-center">
          <input
            type="checkbox"
            :checked="selectedIds.includes(row.id)"
            @change="emit('toggleRow', row.id)"
            class="cursor-pointer"
          />
        </td>

        <td v-for="col in columns" :key="col.key" class="border border-gray-300 px-3 py-2 text-sm">
          <!-- Serial -->
          <span v-if="col.key === 'sl'">
  {{ (currentPage - 1) * perPage + index + 1 }}
</span>

          <span v-else>{{ row[col.key] ?? 'N/A' }}</span>
        </td>

        <!-- 🔥 Dynamic Actions -->
        <td v-if="showActions" class="border border-gray-300 px-3 py-2">
          <div class="flex justify-center gap-3">
            <slot name="actions" :row="row" :index="index" />
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script setup>
defineProps({
  columns: {
    type: Array,
    required: true,
  },
  rows: {
    type: Array,
    required: true,
  },
  showActions: {
    type: Boolean,
    default: false,
  },
  selectable: {
    type: Boolean,
    default: false,
  },
  selectedIds: {
    type: Array,
    default: () => [],
  },
  currentPage: {
    type: Number,
    default: 1,
  },
  perPage: {
    type: Number,
    default: 10,
  },
})

const emit = defineEmits(['toggleAll', 'toggleRow'])
</script>
