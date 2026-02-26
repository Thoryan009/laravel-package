<template>
  <BaseModal
    :isVisible="store.isEditModal"
    :title="`Edit ${store.moduleName}`"
    :maxWidth="`${store.modalWidth}`"
    @close="store.handleToggleModal"
  >
   <CommonForm v-model:formData="formData" :countries="countries" :onSubmit="handleSubmit"
      :onCancel="store.handleToggleModal" />
  </BaseModal>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useClientMutations } from '@/modules/client/queries/useClientMutations'
import { useClientStore } from '@/modules/client/store/clientStore'
import { useClientCountriesQuery } from '../../queries/useClientsQuery'
import CommonForm from './CommonForm.vue'

const { data } = useClientCountriesQuery()

const countries = computed(() => data.value?.data?.data ?? [])

const store = useClientStore()
const formData = ref({
  id: '',
  name: '',
  email: '',
  phone: '',
  client_id: '',
  country_id: '',
  password: '',
})

watch(
  () => store.item,
  (newItem) => {
    if (!newItem) return

    Object.keys(formData.value).forEach((key) => {
      formData.value[key] = newItem[key] ?? formData.value[key]
    })
  },
  { immediate: true }
)

const { update } = useClientMutations(store.moduleName, {
  onSuccess() {
    store.handleToggleModal() // ✅ close modal
  },
  onError: (error) => {
    console.log('Custom error handling', error)
  },
})

const handleSubmit = async () => {
  await update.mutateAsync(formData.value)
}
</script>
