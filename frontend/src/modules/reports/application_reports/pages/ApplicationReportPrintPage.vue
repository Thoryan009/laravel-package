<template>
  <!-- Page wrapper -->
  <div class="min-h-screen flex flex-col">
    <div class="w-[400mm] mx-auto py-4 px-0 rounded-lg flex flex-col flex-1">
      <!-- Header -->
      <div class="flex justify-between items-center">
        <LeftHeader />
      </div>

      <!-- Title -->
      <div class="mt-3 mb-2">
        <h2 class="text-lg font-semibold text-gray-800 capitalize">
          {{ reportTitle }}
        </h2>
      </div>

      <!-- Content Card -->
      <div class="rounded-lg bg-white shadow-sm">
        <div>
          <BaseTable :columns="columns" :rows="rows" />
        </div>
      </div>
    </div>

    <p class="text-xs text-gray-600 mt-1 text-center">
      This ATS report is generated based on system data available as of <span class="font-semibold">09 Feb 2026</span>.
    </p>


  </div>
</template>

<script setup>
import { onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import { useCrudTable } from '@/shared/composables/useCrudTable';
import { useApplicationReportStore } from '../store/applicationReportStore';
import { useApplicationReportsQuery } from '../queries/useApplicationReportsQuery';
import { formatDate } from '@/shared/helpers/formatDateTime';
import LeftHeader from '../../shared/LeftHeader.vue';


const route = useRoute()
const store = useApplicationReportStore();

console.log(route);

const reportType = route.params.type

const { columns } = useCrudTable(store, [
  { key: 'job', label: 'Job Name' },
  { key: 'sur_name', label: 'Sur Name' },
  { key: 'given_name', label: 'Given Name' },
  { key: 'country', label: 'Country' },
  { key: 'client', label: 'Client' },
  { key: 'work_order_id', label: 'Demand Letter' },
  { key: 'sex', label: 'Sex' },
  { key: 'mobile', label: 'Mobile' },
  { key: 'email', label: 'Email' },
  { key: 'payer', label: 'Payer' },
  { key: 'passport_no', label: 'Passport No' },
  { key: 'application_id', label: 'Application ID' },
  { key: 'status', label: 'Status' },
], { timestamps: false })


const filters = computed(() => ({
  country_id: route.query.country_id || null,
  work_order_id: route.query.work_order_id || null,
  job_id: route.query.job_id || null,
  from_date: route.query.from_date || null,
  to_date: route.query.to_date || null,
  type: route.params.type,
}))

const { data } = useApplicationReportsQuery(filters)
const rows = computed(() => data.value?.data?.data ?? [])

const countryName = computed(() => route.query.countryName || null)
const jobName = computed(() => route.query.jobName || null)
const workOrderCode = computed(() => route.query.workOrderId || null)
const clientName = computed(() => route.query.clientId || null)
const fromDate = computed(() => route.query.from_date || null)
const toDate = computed(() => route.query.to_date || null)

const reportTitle = computed(() => {
  // base title
  let title = `${reportType} Report`

  // collect optional parts
  const parts = []

  if (jobName.value) {
    parts.push(jobName.value)
  }

  if (workOrderCode.value) {
    parts.push(`${workOrderCode.value}`)
  }

  if (countryName.value) {
    parts.push(countryName.value.replaceAll('_', ' '))
  }

  if (clientName.value) {
    parts.push(clientName.value.replaceAll('_', ' '))
  }

  // add date range
  if (fromDate.value || toDate.value) {
    const dateText = `${formatDate(fromDate.value) || 'Start'} → ${formatDate(toDate.value) || 'Now'}`
    parts.push(dateText)
  }

  // append only if something exists
  if (parts.length) {
    title += ` - ${parts.join(' | ')}`
  }

  return title
})


// onMounted(() => {
//   setTimeout(() => {
//     window.print()
//   }, 1000)
// })

</script>

<style scoped>

</style>
