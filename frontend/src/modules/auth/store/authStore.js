import { defineStore } from 'pinia'
export const useAuthStore = defineStore('auth', () => {
  const moduleName = 'Auth'

  return {
    moduleName,
  }
})
