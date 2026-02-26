import { useQuery } from '@tanstack/vue-query'
import { fetchAll, fetchOne } from '../services/atsReportService'
import { computed, unref } from 'vue'

export function useAtsReportsQuery(filtersRef) {
  const processId = computed(() => unref(filtersRef)?.process_id)
  const workOrderId = computed(() => unref(filtersRef)?.work_order_id)
  const jobId = computed(() => unref(filtersRef)?.job_id)
  const type = computed(() => unref(filtersRef)?.type)
  const fromDate = computed(() => unref(filtersRef)?.from_date)
  const toDate = computed(() => unref(filtersRef)?.to_date)
  const cacheKey = 'ats-reports'

  return useQuery({
    queryKey: computed(() => [
      cacheKey,
      processId.value || 'all',
      workOrderId.value || 'all',
      jobId.value || 'all',
      type.value || 'all',
      fromDate.value || 'all',
      toDate.value || 'all',
    ]),

    queryFn: () =>
      fetchAll({
        process_id: processId.value,
        work_order_id: workOrderId.value,
        job_list_id: jobId.value,
        type: type.value,
        from_date: fromDate.value,
        to_date: toDate.value,
      }),

    staleTime: 5 * 60 * 1000,
    cacheTime: 60 * 60 * 1000,
    keepPreviousData: true,

    meta: {
      persist: true,
    },
  })
}

export function useAtsReportQuery(filtersRef) {
  const processId = computed(() => unref(filtersRef)?.process_id)
  const workOrderId = computed(() => unref(filtersRef)?.work_order_id)
  const jobId = computed(() => unref(filtersRef)?.job_id)
  const type = computed(() => unref(filtersRef)?.type)
  const fromDate = computed(() => unref(filtersRef)?.from_date)
  const toDate = computed(() => unref(filtersRef)?.to_date)
  const cacheKey = 'ats-report'

  return useQuery({
    queryKey: computed(() => [
      cacheKey,
      processId.value || 'all',
      workOrderId.value || 'all',
      jobId.value || 'all',
      type.value || 'all',
      fromDate.value || 'all',
      toDate.value || 'all',
    ]),

    queryFn: () =>
      fetchOne({
        process_id: processId.value,
        work_order_id: workOrderId.value,
        job_list_id: jobId.value,
        type: type.value,
        from_date: fromDate.value,
        to_date: toDate.value,
      }),

    staleTime: 5 * 60 * 1000,
    cacheTime: 60 * 60 * 1000,
    keepPreviousData: true,

    meta: {
      persist: true,
    },
  })
}
