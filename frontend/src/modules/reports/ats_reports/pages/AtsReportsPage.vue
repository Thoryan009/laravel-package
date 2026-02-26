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
      <AtsReportNavigation />
    </div>
    <pre>{{ reportsData }}</pre>
    <!-- ATS Detailed Report Section -->
    <AtsDemoSection />

  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useAtsReportStore } from '../store/atsReportStore';
import AtsReportNavigation from './components/AtsReportNavigation.vue';
import AtsDemoSection from './components/AtsDemoSection.vue';
import { useAtsReportsQuery } from '../queries/useAtsReportsQuery';

const store = useAtsReportStore();

</script>
