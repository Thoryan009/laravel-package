<template>
  <div class="min-h-screen bg-gray-50 space-y-2">

    <!-- Header -->
    <PageHeader title="Transaction Reports" subtitle="Financial transactions overview" />
    <!-- <pre>{{ reportsData }}</pre> -->
    <!-- Summary Stats -->
    <StatsGrid :items="stats" />

    <!-- Transaction Flow -->
    <PipelineProgress  title="Transaction Flow" :data="reportsData"  totalKey="total_transactions_count" :items="pipelineItems" />

    <!-- Recent Last 10 Reports -->
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Transaction Reports</h2>

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
import { useTransactionReportStore } from '../../store/transactionReportStore';
import PageHeader from '@/modules/reports/shared/PageHeader.vue';
import StatsGrid from '@/modules/reports/shared/StatsGrid.vue';
import { useTransactionReportsQuery } from '../../queries/useTransactionReportsQuery';
import PipelineProgress from '@/modules/reports/shared/PipelineProgress.vue';
import { useCrudTable } from '@/shared/composables/useCrudTable';

const store = useTransactionReportStore();

const { columns } = useCrudTable(store,
  [
    { key: 'transaction_id', label: 'Transaction ID' },
    { key: 'bill_no', label: 'Bill No' },
    { key: 'client', label: 'Client' },
    { key: 'work_order_id', label: 'Demand Letter Id' },
    { key: 'job', label: 'Jobs' },
    { key: 'total_amount', label: 'Total Amount' },
    { key: 'paid_amount', label: 'Paid Amount' },
    { key: 'candidate_name', label: 'Candiate' },
    { key: 'payment_method', label: 'Payment Method' },
    { key: 'payment_date', label: 'Payment Date' },
    { key: 'payment_time', label: 'Payment Time' },
    { key: 'status', label: 'Status' },
  ],
  { timestamps: false }
)

const { data } = useTransactionReportsQuery()
const reportsData = computed(() => data.value?.data?.data ?? {})
const recentReports = computed(() =>
  (reportsData.value?.recent_transactions ?? []).slice(0, 10)
)

const stats = computed(() => [
  {
    key: 'total_transactions_count',
    label: 'Total Transactions Count',
    value: reportsData.value.total_transactions_count,
  },
  {
    key: 'total_amount',
    label: 'Total Amount',
    value: reportsData.value.total_amount,
  },
  {
    key: 'total_paid_amount',
    label: 'Total Paid Amount',
    value: reportsData.value.total_paid_amount,
  },
  {
    key: 'total_due_amount',
    label: 'Total Due Amount',
    value: reportsData.value.total_due_amount,
  },
])

const pipelineItems = [
  { key: 'total_client_transactions_count', label: 'Client' },
  { key: 'total_candidate_transactions_count', label: 'Candidate' }
]

</script>
