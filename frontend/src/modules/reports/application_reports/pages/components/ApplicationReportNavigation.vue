<template>
  <div class="flex gap-4 my-4">
    <router-link v-for="route in routes" :key="route.name" :to="{ name: 'Worker Report', params: { type: route.type } }"
      class="px-4 py-2 rounded-xl border cursor-pointer transition-all bg-white text-gray-700 shadow-sm hover:shadow-md hover:-translate-y-0.5"
      :class="currentRoute === route.type ? 'border-blue-500 bg-blue-50! ring-1 ring-blue-300' : 'border-gray-200'">
      <p class="text-sm font-semibold">
        {{ route.label }}
      </p>
      <p class="text-xs mt-1 text-gray-500">
        {{ route.description }}
      </p>
    </router-link>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

// computed instead of manual assignment
const currentRoute = computed(() => route.params.type)

const routes = [
  {
    name: 'Worker Report',
    label: 'Worker Report',
    description: 'Worker report description',
    type: 'worker',
  },
]


</script>
