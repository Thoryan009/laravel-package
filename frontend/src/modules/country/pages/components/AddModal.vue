<template>
  <BaseModal :isVisible="store.isModal" :title="`Add ${store.moduleName}`" :maxWidth="`${store.modalWidth}`"
    @close="store.handleToggleModal">

    <CommonForm v-model:formData="formData" :onSubmit="handleSubmit" :onCancel="store.handleToggleModal" />
  </BaseModal>
</template>

<script setup>
import { ref } from 'vue'
import CommonForm from './CommonForm.vue'
import { useCountryMutations } from '@/modules/country/queries/useCountryMutations'
import app from '@/shared/config/appConfig'
import { useCountryStore } from '@/modules/country/store/countryStore'

const store = useCountryStore()

console.log(app)

// Default Form Data
const defaultFormData = {
  name: 'Test Name',
}

// Initialize formData
const formData = ref(
  app.moduleLocal
    ? { ...defaultFormData }
    : Object.fromEntries(Object.keys(defaultFormData).map((key) => [key, '']))
)



const { submit } = useCountryMutations(store.moduleName, {
  onSuccess() {
    store.handleToggleModal()
    store.handleReset(formData.value)
  },
  onError(error) {
    console.log('Error:', error)
  },
})

// Submit handler
const handleSubmit = async () => {
  await submit.mutateAsync(formData.value)
}
</script>
