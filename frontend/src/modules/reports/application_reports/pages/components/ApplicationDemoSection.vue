<template>
  <div class="min-h-screen bg-gray-50 space-y-2">

    <!-- Header -->
    <div class="flex justify-between items-center">
      <div>
        <h1 class="text-2xl font-bold text-gray-800">Worker Reports</h1>
        <p class="text-sm text-gray-500">Application management overview</p>
      </div>
      <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Export
      </button>
    </div>

    <!-- Stats -->

    <StatsGrid :items="stats" />


    <!-- Recent Applications -->
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">
        Recent Application Reports
      </h2>

      <!-- Content Card -->
      <div class="rounded-lg bg-white shadow-sm">
        <div>
          <BaseTable :columns="columns" :rows="recentReports" />
        </div>
      </div>

    </div>

  </div>
</template>

<script setup>
import { computed } from 'vue';
import PageHeader from '@/modules/reports/shared/PageHeader.vue';
import StatsGrid from '@/modules/reports/shared/StatsGrid.vue';
import { useApplicationReportsQuery } from '../../queries/useApplicationReportsQuery';
import PipelineProgress from '@/modules/reports/shared/PipelineProgress.vue';
import { useApplicationReportStore } from '../../store/applicationReportStore';
import { useCrudTable } from '@/shared/composables/useCrudTable';

const store = useApplicationReportStore();

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
], { timestamps: false })

const { data } = useApplicationReportsQuery()
const reportsData = computed(() => data.value?.data ?? {})
const recentReports = computed(() =>
  (reportsData.value?.recent_applications ?? []).slice(0, 10)
)

const stats = computed(() => [
  {
    key: 'total_applications',
    label: 'Total Applications',
    value: reportsData.value?.total_applications ?? 0,
  },
  {
    key: 'total_application_process',
    label: 'Total Application Process',
    value: reportsData.value?.total_application_process ?? 0,
  },
])

const pipelineItems = [
  { key: 'total_applications', label: 'Applications', showProgress: false },
  { key: 'total_application_process', label: 'Processes', showProgress: false }
]

</script>
