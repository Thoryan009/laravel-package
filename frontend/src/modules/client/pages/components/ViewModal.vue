<template>
  <BaseModal :isVisible="store.isViewModal" :title="`View ${store.moduleName} Details`" :maxWidth="`60vw`"
    @close="store.handleToggleModal">
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
          <strong>Email:</strong>
          {{ store.item.email }}
        </p>
        <p class="text-lg">
          <strong>Phone:</strong>
          {{ store.item.phone }}
        </p>
        <p class="text-lg">
          <strong>Client ID:</strong>
          {{ store.item.client_id }}
        </p>
        <p class="text-lg">
          <strong>Country:</strong>
          {{ store.item.country }}
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
      <!-- Work Order Details -->
      <h2 class="text-lg font-semibold py-5">{{ store.item.name }} Demand Letters</h2>
      <BaseTable v-if="!isLoading" :columns="columns" :rows="store.item.work_orders" />
    </ViewModalLayout>
  </BaseModal>
</template>

<script setup>
import { useClientStore } from '@/modules/client/store/clientStore';
import ViewModalLayout from '@/shared/components/ui/ViewModalLayout.vue';
import { useCrudTable } from '@/shared/composables/useCrudTable';

const store = useClientStore()

const { columns } = useCrudTable(store, [
  { key: 'work_order_id', label: 'Demand Letter' },
  { key: 'candidates', label: 'Candidates' },
  { key: 'end_date_formatted', label: 'End Date' },
  { key: 'client', label: 'Client' },
  { key: 'price', label: 'Price Per Candidate' },
])
</script>
