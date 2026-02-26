<template>
  <header
    class="flex h-16 items-center justify-between border-b bg-white px-4 shadow-sm sm:px-6 lg:px-5"
  >
    <!-- Left -->
    <div class="flex items-center">
      <button
        @click="$emit('toggle-sidebar')"
        class="mr-4 text-gray-600 hover:text-gray-800 lg:hidden"
      >
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <h2 class="text-xl font-semibold text-gray-800">
        {{ activeNav }}
      </h2>
    </div>

    <!-- Right -->
    <div class="relative">
      <!-- Profile Button -->
      <button
        @click="$emit('toggle-profile-dropdown')"
        class="flex items-center space-x-2 rounded-full p-2 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
      >
        <UserAvatar :name="user?.name" :type="user?.type" />

        <svg
          class="hidden h-5 w-5 text-gray-600 sm:block"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <!-- Dropdown -->
      <div
        v-if="isProfileDropdownOpen"
        class="absolute right-0 z-10 mt-2 w-52 rounded-lg bg-white py-2 shadow-xl ring-1 ring-black ring-opacity-5"
      >
        <!-- User Info -->
        <div class="border-b px-4 py-3">
          <p class="text-sm font-medium text-gray-900">
            {{ user?.name }}
          </p>
          <p class="text-xs text-gray-500">
            {{ user?.email }}
          </p>

          <span
            class="mt-1 inline-flex rounded-full px-2 py-0.5 text-xs font-medium"
            :class="userTypeBadgeClass"
          >
            {{ formattedUserType }}
          </span>
        </div>

        <!-- Actions -->
        <router-link
          to="/settings"
          @click.prevent="$emit('profile-action', 'settings')"
          class="flex items-center px-4 py-2 text-sm hover:bg-gray-100"
        >
          Settings
        </router-link>

        <button
          @click="$emit('profile-action', 'logout')"
          class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
        >
          Logout
        </button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue'
import UserAvatar from './UserAvatar.vue'
import {
  getFormattedUserType,
  getUserTypeClasses,
} from '@/shared/helpers/userHelpers'

const props = defineProps({
  activeNav: String,
  isProfileDropdownOpen: Boolean,
  user: Object,
})

const formattedUserType = computed(() =>
  getFormattedUserType(props.user?.type)
)

const userTypeBadgeClass = computed(() =>
  getUserTypeClasses(props.user?.type).badge
)
</script>
