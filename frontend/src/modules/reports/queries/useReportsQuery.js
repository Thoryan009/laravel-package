import { useQuery } from '@tanstack/vue-query'
import {
  fetchStatus,
  fetchMethods,
  fetchJobs,
  fetchProcess,
  fetchWorkOrders,
  fetchClients,
  fetchCountries,

} from '../services/reportService'

// Report Process
export function useReportProcessQuery() {
  return useQuery({
    queryKey: ['report-processes'], // recent_process_reports
    queryFn: fetchProcess,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}

// Report Work Orders
export function useReportWorkOrdersQuery() {
  return useQuery({
    queryKey: ['report-work-orders'],
    queryFn: fetchWorkOrders,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}

// Report Jobs
export function useReportJobsQuery() {
  return useQuery({
    queryKey: ['report-jobs'],
    queryFn: fetchJobs,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}

// Payment Status
export function useReportStatusQuery() {
  return useQuery({
    queryKey: ['report-transaction-status'],
    queryFn: fetchStatus,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}

// Payment Method
export function useReportMethodsQuery() {
  return useQuery({
    queryKey: ['report-payment-methods'],
    queryFn: fetchMethods,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}

// Client
export function useReportClientsQuery() {
  return useQuery({
    queryKey: ['report-clients'],
    queryFn: fetchClients,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}


// Country
export function useReportCountryQuery() {
  return useQuery({
    queryKey: ['report-countries'],
    queryFn: fetchCountries,
    staleTime: Infinity, // rarely changes
    cacheTime: 24 * 60 * 60 * 1000,
    meta: {
      persist: true,
    },
  })
}
