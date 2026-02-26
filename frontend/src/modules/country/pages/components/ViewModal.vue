<template>
  <BaseModal :isVisible="store.isViewModal" :title="`View ${store.moduleName} Details`"
    :maxWidth="`60vw`" @close="store.handleToggleModal">
    <ViewModalLayout>
      <div class="space-y-2">
        <p class="text-lg">
          <strong>ID:</strong>
          {{ store.item.id }}
        </p>
        <p class="text-lg">
          <strong>Name:</strong>
          {{ store.item.name }}
        </p>
        <p class="text-lg">
          <strong>Created At:</strong>
          {{ store.item.created_at }}
        </p>
        <p class="text-lg">
          <strong>Updated At:</strong>
          {{ store.item.updated_at }}
        </p>
      </div>
      <!-- ClientDetails -->
       <h2 class="text-lg font-semibold py-3">{{ store.item.name }} Clients</h2>
      <BaseTable v-if="store.item" :columns="columns" :rows="store.item.clients" />
    </ViewModalLayout>
  </BaseModal>
</template>

<script setup>
import { useCountryStore } from '@/modules/country/store/countryStore';
import ViewModalLayout from '@/shared/components/ui/ViewModalLayout.vue';
import { useCrudTable } from '@/shared/composables/useCrudTable';

const store = useCountryStore()

const { columns } = useCrudTable(store, [
  { key: 'name', label: 'Client' },
  { key: 'email', label: 'Email' },
  { key: 'phone', label: 'Phone' },
  { key: 'client_id', label: 'Client ID' },
  { key: 'country', label: 'Country' },
])

</script>
