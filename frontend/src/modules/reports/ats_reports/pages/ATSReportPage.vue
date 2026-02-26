<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <!-- Responsive Heading -->
        <PageTitle className="capitalize">{{ reportType }} Process Reports</PageTitle>
      </div>
    </div>
    <!-- Report Cards -->
    <div class=" flex justify-between items-center">
      <AtsReportNavigation />
      <div>
        <BaseButton @click="goToPrint">Print ATS Report</BaseButton>
      </div>
    </div>

    <!-- FILTERS -->
    <div class="flex justify-end items-center my-4">
      <TableFilters :show-search="false" :filters="filters" :has-active-filters="hasActiveFilters"
        @reset="resetFilters">
        <!-- PROCESS FILTER -->
        <div class="flex flex-col">
          <label class="text-gray-800 text-[15px]">Process</label>
          <BaseSelect v-model="filters.process_id" :options="processOptions" placeholder="Select" />
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
import { useAtsReportStore } from '../store/atsReportStore';
import { useTableFilters } from '@/shared/composables/useTableFilters';
import { useReportJobsQuery, useReportProcessQuery, useReportWorkOrdersQuery } from '../../queries/useReportsQuery';
import { removeEmptyKeys } from '@/shared/helpers/objectHelper';
import { useAtsReportQuery } from '../queries/useAtsReportsQuery';
import TableFilters from '@/shared/components/ui/TableFilters.vue';
import AtsReportNavigation from './components/AtsReportNavigation.vue';
import PageTitle from '@/shared/components/ui/PageTitle.vue';

const route = useRoute();
const router = useRouter();
const reportType = computed(() => route.params.type)
const store = useAtsReportStore();

const { filters, resetFilters } = useTableFilters({
  process_id: null,
  work_order_id: null,
  job_id: null,
  type: reportType,
  from_date: null,
  to_date: null,
})

const hasActiveFilters = computed(() => {
  return Object.entries(filters.value).some(([key, value]) => key !== 'type' && value);
})


const { data } = useAtsReportQuery(filters)
const rows = computed(() => data.value?.data?.data ?? [])


const { columns } = useCrudTable(store, [
  { key: 'job_name', label: 'Job Name' },
  { key: 'work_order', label: 'Demand Letter' },
  { key: 'client', label: 'Client' },
  { key: 'payer', label: 'Payer' },
  { key: 'candidate', label: 'Candidate Name' },
  { key: 'phone', label: 'Phone' },
  // { key: 'email', label: 'Email' },
  { key: 'process', label: 'Process' },
  { key: 'age', label: 'Age' },
  { key: 'started_at', label: 'Started At' },
  { key: 'completed_at', label: 'Completed At' },
])


const goToPrint = () => {
  const filtered = removeEmptyKeys(filters.value);

  filtered.jobName = filtered.job_id
    ? getJobNameById(filtered.job_id)
    : '';

  filtered.workOrderId = filtered.work_order_id
    ? getWorkOrderIdById(filtered.work_order_id)
    : '';

  filtered.processName = filtered.process_id
    ? getProcessNameById(filtered.process_id)
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
    name: 'ATS Report Print',
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

const getProcessNameById = (processId) => {
  return processOptions.value.find(process => process.id == processId).name
}


const { data: processData } = useReportProcessQuery()
const { data: workOrdersData } = useReportWorkOrdersQuery()
const { data: jobsData } = useReportJobsQuery()

const processOptions = computed(() => processData.value?.data ?? [])
const workOrderOptions = computed(() => workOrdersData.value?.data ?? [])
const jobOptions = computed(() => jobsData.value?.data ?? [])

</script>
