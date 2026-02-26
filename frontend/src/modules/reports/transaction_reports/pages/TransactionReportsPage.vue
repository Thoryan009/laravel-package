<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <!-- Responsive Heading -->
        <PageTitle>{{ store.moduleName }} List</PageTitle>
      </div>
    </div>

    <!-- Top Report Cards -->
    <div class="mb-10">
      <!-- Active -->
      <TransactionReportNavigation />
    </div>
    <!-- Transaction Detailed Report Section -->
    <TransactionDemoSection />

  </div>
</template>

<script setup>
import { useTransactionReportStore } from '../store/transactionReportStore';
import TransactionReportNavigation from './components/TransactionReportNavigation.vue';
import TransactionDemoSection from './components/TransactionDemoSection.vue';

const store = useTransactionReportStore();



</script>
