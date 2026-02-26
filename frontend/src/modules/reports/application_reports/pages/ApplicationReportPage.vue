<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <!-- Responsive Heading -->
        <PageTitle className="capitalize">{{ reportType }} Reports</PageTitle>
      </div>
    </div>
    <!-- Report Cards -->
    <div class=" flex justify-between items-center">
      <ApplicationReportNavigation />
      <div>
        <BaseButton @click="goToPrint">Print Application Report</BaseButton>
      </div>
    </div>
    <!-- FILTERS -->
    <div class="flex justify-end items-center my-4">
      <TableFilters :show-search="false" :filters="filters" :has-active-filters="hasActiveFilters"
        @reset="resetFilters">
        <!-- Countries FILTER -->
        <div class="flex flex-col">
          <label class="text-gray-800 text-[15px]">Countries</label>
          <BaseSelect v-model="filters.country_id" :options="countryOptions" placeholder="Select" />
        </div>
        <!-- Work Order FILTER -->
        <div class="flex flex-col">
          <label class="text-gray-800 text-[15px]">Demand Letter</label>
          <BaseSelect v-model="filters.work_order_id" :options="workOrderOptions" placeholder="Select" />
        </div>
        <!-- Jobs FILTER -->
        <div class="flex flex-col">
          <label class="text-gray-800 text-[15px]">Jobs</label>
          <BaseSelect v-model="filters.job_id" :options="jobOptions" placeholder="Select" />
        </div>
         <!-- Clients -->
        <div class="flex flex-col">
          <label class="text-gray-800 text-[15px]">Clients</label>
          <BaseSelect v-model="filters.client_id" :options="clientOptions" placeholder="Select" />
        </div>
      </TableFilters>
    </div>

    <!-- Content Card -->
    <div class="rounded-lg bg-white shadow-sm">
      <div>
        <BaseTable :columns="columns" :rows="rows" />
      </div>
    </div>

  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useCrudTable } from '@/shared/composables/useCrudTable';
import { useApplicationReportStore } from '../store/applicationReportStore';
import { useTableFilters } from '@/shared/composables/useTableFilters';
import { useApplicationReportQuery } from '../queries/useApplicationReportsQuery';
import { useReportClientsQuery, useReportCountryQuery, useReportJobsQuery, useReportWorkOrdersQuery } from '../../queries/useReportsQuery';
import { removeEmptyKeys } from '@/shared/helpers/objectHelper';
import TableFilters from '@/shared/components/ui/TableFilters.vue';
import ApplicationReportNavigation from './components/ApplicationReportNavigation.vue';
import PageTitle from '@/shared/components/ui/PageTitle.vue';

const route = useRoute();
const router = useRouter();
const reportType = computed(() => route.params.type)
const store = useApplicationReportStore();

const { filters, resetFilters } = useTableFilters({
  country_id: null,
  work_order_id: null,
  job_id: null,
  client_id: null,
  type: reportType,
  from_date: null,
  to_date: null,
})

const hasActiveFilters = computed(() => {
  return Object.entries(filters.value).some(([key, value]) => key !== 'type' && value);
})

const { data } = useApplicationReportQuery(filters)
const rows = computed(() => data.value?.data?.data ?? [])

const { columns } = useCrudTable(store, [
  { key: 'job_name', label: 'Job Name' },
  { key: 'sur_name', label: 'Sur Name' },
  { key: 'given_name', label: 'Given Name' },
  { key: 'country', label: 'Country' },
  { key: 'client', label: 'Client' },
  { key: 'work_order_id', label: 'Demand Letter' },
  { key: 'sex', label: 'Sex' },
  { key: 'mobile', label: 'Mobile' },
  // { key: 'email', label: 'Email' },
  { key: 'payer', label: 'Payer' },
  { key: 'passport_no', label: 'Passport No' },
  { key: 'application_id', label: 'Application ID' },
  { key: 'status', label: 'Status' },
])


const goToPrint = () => {
  const filtered = removeEmptyKeys(filters.value);

  filtered.jobName = filtered.job_id
    ? getJobNameById(filtered.job_id)
    : '';

  filtered.workOrderId = filtered.work_order_id
    ? getWorkOrderIdById(filtered.work_order_id)
    : '';

  filtered.countryName = filtered.country_id
    ? getCountryNameById(filtered.country_id)
    : '';

  filtered.clientId = filtered.client_id
    ? getClientNameById(filtered.client_id)
    : '';

  // ADD DATES
  filtered.from_date = filtered.from_date
    ? filtered.from_date
    : '';

  filtered.to_date = filtered.to_date
    ? filtered.to_date
    : '';

  const filteredFinal = removeEmptyKeys(filtered);

  // create route URL
  const routeData = router.resolve({
    name: 'Worker Report Print',
    params: {
      type: reportType.value
    },
    query: filteredFinal
  });

  console.log(routeData);

  // open new tab
  window.open(routeData.href, '_blank');
};

const getJobNameById = (jobId) => {
  return jobOptions.value.find(job => job.id == jobId).name
}

const getWorkOrderIdById = (workOrderId) => {
  return workOrderOptions.value.find(workOrder => workOrder.id == workOrderId).name
}

const getCountryNameById = (countryId) => {
  return countryOptions.value.find(country => country.id == countryId).name
}

const getClientNameById = (clientId) => {
  return clientOptions.value.find(client => client.id == clientId).name
}

const { data: countryData } = useReportCountryQuery()
const { data: workOrdersData } = useReportWorkOrdersQuery()
const { data: jobsData } = useReportJobsQuery()
const { data: clientsData } = useReportClientsQuery()

const countryOptions = computed(() => countryData.value?.data ?? [])
const workOrderOptions = computed(() => workOrdersData.value?.data ?? [])
const jobOptions = computed(() => jobsData.value?.data ?? [])
const clientOptions = computed(() => clientsData.value?.data ?? [])

</script>
