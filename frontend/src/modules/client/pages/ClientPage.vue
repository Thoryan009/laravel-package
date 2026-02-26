<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <!-- Responsive Heading -->
        <PageTitle>{{ store.moduleName }} List</PageTitle>
      </div>
      <BaseButton @click="store.handleToggleModal('add')">Add {{ store.moduleName }}</BaseButton>
    </div>

    <!-- Bulk Delete & All Kinds Of Filters  -->
    <div class="flex justify-between items-center my-4">
      <!-- BULK DELETE -->
      <div>
        <BaseButton
          v-if="selectedIds.length"
          class="bg-red-600 text-white hover:bg-red-700"
          @click="bulkDelete"
          >Delete Selected ({{ selectedIds.length }})</BaseButton
        >
      </div>
      <div></div>
      <!-- FILTERS -->
      <TableFilters :filters="filters" :has-active-filters="hasActiveFilters" @reset="resetFilters">
        <!-- MODULE-SPECIFIC FILTER -->
        <div class="flex flex-col">
          <label class="text-gray-800 text-[15px]">Country</label>
          <BaseSelect v-model="filters.country_id" :options="countries" placeholder="Select" />
        </div>
      </TableFilters>
    </div>

    <!-- Content Card -->
    <div class="rounded-lg bg-white shadow-sm">
      <div>
        <BaseTable
          v-if="!isLoading"
          :columns="columns"
          :rows="rows"
          :current-page="page"
          :per-page="perPage"
          show-actions
          selectable
          :selected-ids="selectedIds"
          @toggleAll="(checked) => toggleAll(rows, checked)"
          @toggleRow="toggleRow"
        >
          <template #actions="{ row }">
            <button @click="onView(row)" class="text-blue-600 cursor-pointer">
              <i class="fa fa-eye"></i>
            </button>

            <button @click="onEdit(row)" class="text-green-600 cursor-pointer">
              <i class="fa fa-pencil"></i>
            </button>

            <button @click="onDelete(row)" class="text-red-600 cursor-pointer">
              <i class="fa fa-trash"></i>
            </button>
          </template>
        </BaseTable>

        <!-- Pagination, Per Page & Showing Records -->
        <BasePagination
          v-if="!isLoading"
          :total="total"
          :showing="showing"
          :links="links"
          :per-page="perPage"
          @update:page="setPage"
          @update:perPage="setPerPage"
        />

        <AddModal />
        <EditModal />
        <ViewModal />
        <DeleteModal />
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, defineAsyncComponent } from 'vue'
import { useClientCountriesQuery, useClientsQuery } from '../queries/useClientsQuery'
import { useClientStore } from '../store/clientStore'
import { usePagination } from '@/shared/composables/usePagination'
import { useClientMutations } from '../queries/useClientMutations'
import { useBulkDelete } from '@/shared/composables/useBulkDelete'
import { useCrudTable } from '@/shared/composables/useCrudTable'
import { useTableFilters } from '@/shared/composables/useTableFilters'
import TableFilters from '@/shared/components/ui/TableFilters.vue'

const ViewModal = defineAsyncComponent(() => import('./components/ViewModal.vue'))
const AddModal = defineAsyncComponent(() => import('./components/AddModal.vue'))
const EditModal = defineAsyncComponent(() => import('./components/EditModal.vue'))
const DeleteModal = defineAsyncComponent(() => import('./components/DeleteModal.vue'))

const store = useClientStore()

const { filters, hasActiveFilters, resetFilters } = useTableFilters({
  searchQuery: '',
  country_id: null,
  from_date: null,
  to_date: null,
})

const pagination = usePagination()
const { page, perPage, total, showing, links, setPage, setPerPage } = pagination

const { data, isLoading } = useClientsQuery(page, perPage, filters)
const { data: countriesData } = useClientCountriesQuery()

pagination.bindMeta(data)

const { removeItems } = useClientMutations(store.moduleName)

const { selectedIds, toggleAll, toggleRow, bulkDelete } = useBulkDelete(removeItems)

const { columns, onView, onEdit, onDelete } = useCrudTable(store, [
  { key: 'name', label: 'Client' },
  { key: 'email', label: 'Email' },
  { key: 'phone', label: 'Phone' },
  { key: 'client_id', label: 'Client ID' },
  { key: 'country', label: 'Country' },
])

const rows = computed(() => data.value?.data?.data ?? [])
const countries = computed(() => countriesData.value?.data?.data ?? [])
</script>
