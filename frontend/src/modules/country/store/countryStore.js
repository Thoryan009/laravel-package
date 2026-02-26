import { defineStore } from 'pinia'
import { useModalHelpers } from '@/shared/composables/useModalHelpers'

export const useCountryStore = defineStore('country', () => {
  
  const {
    item,
    isModal,
    isViewModal,
    isEditModal,
    isDeleteModal,
    handleToggleModal,
    handleReset,
  } = useModalHelpers()

  const moduleName = 'Country'
  const modalWidth = '30vw'

  return {
    item,
    isModal,
    isViewModal,
    isEditModal,
    isDeleteModal,
    moduleName,
    modalWidth,
    handleToggleModal,
    handleReset,
  }
})
