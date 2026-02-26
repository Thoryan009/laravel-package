<template>
  <BaseModal :isVisible="store.isEditModal" :title="`Edit ${store.moduleName}`" :maxWidth="`${store.modalWidth}`"
    @close="store.handleToggleModal">
    <CommonForm v-model:formData="formData" :onSubmit="handleSubmit" :onCancel="store.handleToggleModal" />
  </BaseModal>
</template>

<script setup>
import { ref, watch } from 'vue'
import CommonForm from './CommonForm.vue'
import { useCountryMutations } from '@/modules/country/queries/useCountryMutations'
import { useCountryStore } from '@/modules/country/store/countryStore'

const store = useCountryStore()

// Form state
const formData = ref({
  id: '',
  name: '',
})

// Populate form when store.item updates
watch(
  () => store.item,
  (item) => {
    if (item) {
      Object.assign(formData.value, item)
    }
  },
  { immediate: true }
)

// Mutation handler
const { update } = useCountryMutations(store.moduleName, {
  onSuccess() {
    store.handleToggleModal()  // close modal
  },
  onError(error) {
    console.log('Custom error handling:', error)
  },
})

// Submit
const handleSubmit = async () => {
  await update.mutateAsync(formData.value)
}
</script>
