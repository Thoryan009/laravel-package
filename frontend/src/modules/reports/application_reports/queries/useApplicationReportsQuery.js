import { useQuery } from '@tanstack/vue-query'
import { fetchAll, fetchOne } from '../services/applicationReportService'
import { computed, unref } from 'vue'

export function useApplicationReportsQuery(filtersRef) {
  const countryId = computed(() => unref(filtersRef)?.country_id)
  const workOrderId = computed(() => unref(filtersRef)?.work_order_id)
  const clientId = computed(() => unref(filtersRef)?.client_id)
  const jobId = computed(() => unref(filtersRef)?.job_id)
  const type = computed(() => unref(filtersRef)?.type)
  const fromDate = computed(() => unref(filtersRef)?.from_date)
  const toDate = computed(() => unref(filtersRef)?.to_date)
  const cacheKey = 'application-reports'

  return useQuery({
    queryKey: computed(() => [
      cacheKey,
      countryId.value || 'all',
      workOrderId.value || 'all',
      jobId.value || 'all',
      clientId.value || 'all',
      type.value || 'all',
      fromDate.value || 'all',
      toDate.value || 'all',
    ]),

    queryFn: () =>
      fetchAll({
        country_id: countryId.value,
        work_order_id: workOrderId.value,
        job_list_id: jobId.value,
        client_id: clientId.value,
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

export function useApplicationReportQuery(filtersRef) {
  const countryId = computed(() => unref(filtersRef)?.country_id)
  const workOrderId = computed(() => unref(filtersRef)?.work_order_id)
  const clientId = computed(() => unref(filtersRef)?.client_id)
  const jobId = computed(() => unref(filtersRef)?.job_id)
  const type = computed(() => unref(filtersRef)?.type)
  const fromDate = computed(() => unref(filtersRef)?.from_date)
  const toDate = computed(() => unref(filtersRef)?.to_date)
  const cacheKey = 'application-reports'

  return useQuery({
    queryKey: computed(() => [
      cacheKey,
      countryId.value || 'all',
      workOrderId.value || 'all',
      jobId.value || 'all',
      clientId.value || 'all',
      type.value || 'all',
      fromDate.value || 'all',
      toDate.value || 'all',
    ]),

    queryFn: () =>
      fetchOne({
        country_id: countryId.value,
        work_order_id: workOrderId.value,
        job_list_id: jobId.value,
        client_id: clientId.value,
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

