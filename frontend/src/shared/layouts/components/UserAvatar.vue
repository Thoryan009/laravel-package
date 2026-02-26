<template>
  <div
    class="flex h-9 w-9 items-center justify-center rounded-full text-white"
    :class="avatarClass"
  >
    <span class="text-sm font-medium">
      {{ initials }}
    </span>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { getUserInitials, getUserTypeClasses } from '@/shared/helpers/userHelpers'

const props = defineProps({
  name: String,
  type: String,
})

const initials = computed(() => getUserInitials(props.name))
const avatarClass = computed(() => getUserTypeClasses(props.type).avatar)
</script>
