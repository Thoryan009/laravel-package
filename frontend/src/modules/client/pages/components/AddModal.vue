<template>
  <BaseModal :isVisible="store.isModal" :title="`Add ${store.moduleName}`" :maxWidth="`${store.modalWidth}`"
    @close="store.handleToggleModal">
    <!-- Use CommonForm here -->
    <CommonForm v-model:formData="formData" :countries="countries" :onSubmit="handleSubmit"
      :onCancel="store.handleToggleModal" />
  </BaseModal>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useClientStore } from '@/modules/client/store/clientStore'
import { useClientMutations } from '@/modules/client/queries/useClientMutations'
import { useClientCountriesQuery } from '@/modules/client/queries/useClientsQuery'
import app from '@/shared/config/appConfig'
import CommonForm from './CommonForm.vue'

// Store
const store = useClientStore()

// Fetch Countries
const { data } = useClientCountriesQuery()
const countries = computed(() => data.value?.data?.data ?? [])

// Default Form Data
const defaultFormData = {
  name: 'Test Name',
  email: 'test@example.com',
  phone: '+1234567890',
  client_id: 'ABC-1234567890',
  country_id: 1,
  password: 'Test@1234',
}

// Initialize formData
const formData = ref(
  app.moduleLocal
    ? { ...defaultFormData }
    : Object.fromEntries(Object.keys(defaultFormData).map((key) => [key, '']))
)

// Mutation
const { submit } = useClientMutations(store.moduleName, {
  onSuccess() {
    store.handleToggleModal()
    store.handleReset(formData.value)
  },
  onError: (error) => {
    console.log('Custom error handling', error)
  },
})

// Submit handler
const handleSubmit = async () => {
  await submit.mutateAsync(formData.value)
}
</script>
