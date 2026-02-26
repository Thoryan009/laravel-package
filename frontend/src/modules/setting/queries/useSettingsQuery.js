import { computed } from 'vue'
import { useQuery } from '@tanstack/vue-query'
import { fetchOne } from '../services/settingService'

export function useSettingsQuery(settingId) {
  return useQuery({
    queryKey: ['settings'],

    queryFn: () => fetchOne(settingId),

    enabled: computed(() => !!settingId),
    staleTime: 5 * 60 * 1000,
    cacheTime: 60 * 60 * 1000,

    meta: {
      persist: true,
    },
  })
}
