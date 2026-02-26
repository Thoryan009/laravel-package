<template>
  <div class="flex gap-4 my-4">
    <router-link v-for="route in routes" :key="route.name" :to="{ name: 'ATS Report', params: { type: route.type } }"
      class="w-48 px-4 py-2 rounded-xl border cursor-pointer transition-all bg-white text-gray-700 shadow-sm hover:shadow-md hover:-translate-y-0.5"
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
    name: 'Expiring Soon Report',
    label: 'Expiring Soon Report',
    description: 'About to expire shortly',
    type: 'expiring',
  },
  {
    name: 'Expired Report',
    label: 'Expired Report',
    description: 'Already expired records',
    type: 'expired',
  },
   {
    name: 'Active Report',
    label: 'Active Report',
    description: 'Currently valid & running',
    type: 'active',
  },
]


</script>
