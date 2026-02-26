import { useQuery } from '@tanstack/vue-query'
import { getUser } from '../services/authService'

export function useAuthQuery(params = {}) {
  return useQuery({
    queryKey: ['auth', params],
    queryFn: () => getUser(params),
    staleTime: 5 * 60 * 1000,
    cacheTime: 1000 * 60 * 60,
    keepPreviousData: true,
    meta: {
      persist: true, // ✅ persisted
    },
  })
}
