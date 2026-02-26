import { useMutation, useQueryClient } from '@tanstack/vue-query'
import { loginUser, logoutUser } from '../services/authService'
import { toast } from '@/shared/config/toastConfig'

export function useAuthMutations(moduleName, options = {}) {
  const queryClient = useQueryClient()

  const handleSuccess = (data, variables) => {
    toast.success(`${moduleName} operation successful`)
    queryClient.invalidateQueries(['auth'])
    options.onSuccess?.(data, variables)
  }

  const handleError = (error) => {
    console.error(error)
    toast.error(`Request Failed: ${error?.message || 'Unknown error'}`)
    options.onError?.(error)
  }

  const login = useMutation({
    mutationFn: loginUser,
    onSuccess: handleSuccess,
    onError: handleError,
  })

  const logout = useMutation({
    mutationFn: logoutUser,
    onSuccess: handleSuccess,
    onError: handleError,
  })

  return {
    login,
    loginLoading: login.isPending, // ✅ Vue Query v5
    loginError: login.error,
    logout,
    logoutLoading: logout.isPending, // ✅ Vue Query v5
    logoutError: logout.error,
  }
}
