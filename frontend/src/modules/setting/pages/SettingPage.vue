<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="mb-6">
      <PageTitle>Settings</PageTitle>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto mt-10">
      <form v-if="!isLoading" @submit.prevent="handleSubmit" class="space-y-4">

        <!-- Software Name -->
        <div>
          <BaseLabel>Software Name</BaseLabel>
          <BaseInput v-model="formData.software_name" required />
        </div>

        <!-- Company Name -->
        <div>
          <BaseLabel>Company Name</BaseLabel>
          <BaseInput v-model="formData.company_name" required />
        </div>

        <!-- Phone -->
        <div>
          <BaseLabel>Company Phone</BaseLabel>
          <BaseInput v-model="formData.company_phone" required />
        </div>


        <!-- Email -->
        <div>
          <BaseLabel>Company Email</BaseLabel>
          <BaseInput v-model="formData.company_email" />
        </div>

        <!-- Address -->
        <div>
          <BaseLabel>Company Address</BaseLabel>
          <BaseInput v-model="formData.company_address" />
        </div>



        <!-- Logo -->
        <div>
          <BaseLabel>Company Logo</BaseLabel>
          <BaseFileInput accept=".jpg, .jpeg, .png"
            @change="handleFileChange($event, 'company_logo_file', 'company_logo_preview')"
            :fileName="fileName?.company_logo_file" />

          <BaseImagePreview :src="formData.company_logo_preview
              ? formData.company_logo_preview
              : formData?.company_logo_url
            " className="rounded-full w-30 h-30" :showCancel="false" @cancelImage="cancelImage('company_logo')"
            width="120px" height="120px" />
        </div>

        <!-- Save -->
        <div class="pt-4">
          <BaseButton type="submit"> Save Settings </BaseButton>
        </div>
      </form>

      <div v-else class="text-center py-10 text-gray-500">Loading...</div>
    </div>
  </div>
</template>

<script setup>
import { useSettingStore } from '../store/settingStore'
import { useSettingMutations } from '../queries/useSettingMutations'
import { useSettingsQuery } from '../queries/useSettingsQuery'

import { useFileHandler } from '@/shared/composables/useFileHandler'

const store = useSettingStore()

const formData = ref({
  id: '',
  software_name: '',
  company_name: '',
  company_phone: '',
  company_email: '',
  company_address: '',
  company_logo_path: null,
  company_logo_preview: null,
  company_logo_file: null,
  company_logo_url: null,
})

const { handleFileChange, fileName, cancelImage } = useFileHandler(formData.value)

// Fetch settings (single record)
const { data, isLoading } = useSettingsQuery(1)
const settingsData = computed(() => data.value?.data?.data || {})


const { update } = useSettingMutations(store.moduleName, {
  onSuccess() {
    fileName.value.company_logo_file = null
  },
  onError: (error) => {
    console.log('Custom error handling', error)
  },
})

import { computed, ref, watch } from 'vue'


watch(
  settingsData,
  (newItem) => {
    if (!newItem) return

    Object.keys(formData.value).forEach((key) => {
      formData.value[key] = newItem[key] ?? formData.value[key]
    })
  },
  { immediate: true },
)



// Submit
const EXCLUDED_KEYS = ['company_logo_preview', 'company_logo_url']

const handleSubmit = async () => {
  const payload = new FormData()

  for (const [key, value] of Object.entries(formData.value)) {
    if (value !== null && !EXCLUDED_KEYS.includes(key)) {
      payload.append(key, value)
    }
  }

  await update.mutateAsync({
    id: formData.value.id,
    payload,
  })
}

</script>
