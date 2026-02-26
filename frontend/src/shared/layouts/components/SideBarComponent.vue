<template>
  <aside
    :class="[
      'fixed inset-y-0 left-0 z-50 bg-white shadow-lg transition-all duration-300 ease-in-out',
      'lg:relative lg:translate-x-0',
      isSidebarOpen ? 'translate-x-0' : '-translate-x-full',
      isSidebarCollapsed ? 'lg:w-20' : 'lg:w-64',
      'w-64',
    ]"
  >
    <div class="flex h-full flex-col">
      <!-- Logo -->
      <div class="flex h-16 items-center justify-between border-b px-4">
        <h1 v-if="!isSidebarCollapsed" class="text-xl font-bold text-gray-800 whitespace-nowrap">
          ATS Dashboard
        </h1>

        <!-- Desktop collapse button -->
        <button
          @click="$emit('toggle-collapse')"
          class="hidden lg:flex items-center justify-center text-gray-600 hover:text-gray-800"
        >
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              :d="isSidebarCollapsed ? 'M9 5l7 7-7 7' : 'M15 19l-7-7 7-7'"
            />
          </svg>
        </button>

        <!-- Mobile close -->
        <button @click="$emit('toggle-sidebar')" class="lg:hidden text-gray-600">✕</button>
      </div>

      <!-- Navigation Items -->
      <nav class="flex-1 space-y-0 overflow-y-auto px-3 py-4">
        <router-link
          v-for="item in filterNavItemsByRole(role, navItems)"
          :key="item.name"
          :to="item.path"
          class="group flex items-center rounded-lg px-4 py-2.5 text-sm font-medium transition-colors"
          :class="
            (item.name === 'ATS' && $route.name === 'Job ATS' ) ||
            (item.name === 'ATS Reports' && $route.name === 'ATS Report') ||
            (item.name === 'Worker Reports' && $route.name === 'Worker Report') ||
            (item.name === 'Transaction Reports' && $route.name === 'Transaction Report')
              ? 'bg-blue-50 text-blue-700'
              : $route.name === item.name
                ? 'bg-blue-50 text-blue-700'
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
          "
          :title="isSidebarCollapsed ? item.name : ''"
        >
          <span v-html="item.icon" class="h-5 w-5"></span>
          <span v-if="!isSidebarCollapsed" class="ml-3 whitespace-nowrap">{{ item.name }}</span>
        </router-link>
      </nav>
    </div>
  </aside>
</template>

<script setup>
import { watch } from 'vue'
import { useRoute } from 'vue-router'
import { getUserRole } from '@/shared/utils/auth'
import roleBasedNavItems from '@/shared/config/roleBasedNavItems'


const route = useRoute()
 defineProps({
  isSidebarOpen: Boolean,
  isSidebarCollapsed: Boolean,
  navItems: Array,
})


const filterNavItemsByRole = (role, navItems) => {
  const allowedItems = roleBasedNavItems[role] || []
  return navItems.filter((item) => allowedItems.includes(item.name))
}

const emit = defineEmits(['toggle-sidebar', 'toggle-collapse'])

const role = getUserRole()

const hiddenCloseSidebarRoutes = ['POS', 'Job ATS']


watch(
  () => route.name,
  (name) => {
    if (hiddenCloseSidebarRoutes.includes(name)) {
      emit('toggle-sidebar', false)
      emit('toggle-collapse', true)
    }
  },
)
</script>
