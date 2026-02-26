import { useApi } from '@/shared/composables/useApi'

const BASE_URL = '/settings'

const response = (api) => ({
  data: api.data.value,
  error: api.error.value,
})


export const fetchOne = async (id) => {
  const api = useApi()
  await api.sendRequest(`${BASE_URL}/${id}`)
  return response(api)
}

// Update Settings
export async function updateData({ id, payload }) {
  const api = useApi()

  await api.sendRequest(
    `${BASE_URL}/${id}`,
    'POST',
    payload,
    {
      headers: {
        'X-HTTP-Method-Override': 'PUT',
        'Content-Type': 'multipart/form-data',
      },
    }
  )

  if (api.error.value) throw api.error.value
  return api.data.value
}
