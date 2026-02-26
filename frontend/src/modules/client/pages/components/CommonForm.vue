<template>
  <form @submit.prevent="onSubmit" class="space-y-4">
    <!-- Name -->
    <div class="space-y-2">
      <BaseLabel for="name">Name</BaseLabel>
      <BaseInput id="name" v-model="localForm.name" :required="true" placeholder="Eg: Rabit Ltd" />
    </div>

    <!-- Email -->
    <div class="space-y-2">
      <BaseLabel for="email">Email</BaseLabel>
      <BaseInput id="email" type="email" v-model="localForm.email" :required="true"
        placeholder="Eg: rabit@example.com" />
    </div>

    <!-- Phone -->
    <div class="space-y-2">
      <BaseLabel for="phone">Phone</BaseLabel>
      <BaseInput id="phone" type="tel" v-model="localForm.phone" :required="true" placeholder="Eg: +1234567890" />
    </div>

    <!-- Client ID -->
    <div class="space-y-2">
      <BaseLabel for="client_id">Client ID</BaseLabel>
      <BaseInput id="client_id" v-model="localForm.client_id" :required="true" placeholder="Eg: ABC-1234567890" />
    </div>

    <!-- Country -->
    <div class="space-y-2">
      <BaseLabel for="country_name">Country</BaseLabel>
      <BaseSelect id="country_name" v-model="localForm.country_id" :options="countries" placeholder="Select"
        :required="true" />
    </div>

    <!-- Password -->
    <div class="space-y-2">
      <BaseLabel for="password">Password</BaseLabel>

      <div class="relative">
        <BaseInput id="password" type="text" v-model="localForm.password" placeholder="Auto-generate password"
           />

        <!-- Generate Icon -->
        <i class="fa fa-refresh absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500 hover:text-blue-600"
          title="Generate Password" @click="handleGeneratePassword"></i>
      </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-end gap-2 pt-4">
      <BaseButton class="bg-yellow-600 hover:bg-yellow-700" type="button" @click="onCancel">Cancel</BaseButton>
      <BaseButton type="submit">Save</BaseButton>
    </div>
  </form>
</template>

<script setup>
import { usePasswordGenerator } from '@/shared/composables/usePasswordGenerator'
import { ref, watch } from 'vue'

// Props
const props = defineProps({
  formData: { type: Object, required: true },
  countries: { type: Array, default: () => [] },
  onSubmit: { type: Function, required: true },
  onCancel: { type: Function, required: true },
})

// Emit updates
const emit = defineEmits(['update:formData'])

// Local reactive copy
const localForm = ref({ ...props.formData })

// Passowrd Generator
const { generatePassword } = usePasswordGenerator()

const handleGeneratePassword = () => {
  localForm.value.password = generatePassword(10)
}


// Sync back to parent
watch(
  localForm,
  (val) => {
    emit('update:formData', val)
  },
  { deep: true }
)
</script>
