import { defineStore } from 'pinia'
import { useModalHelpers } from '@/shared/composables/useModalHelpers'

export const useClientStore = defineStore('client', () => {
  const { item, isModal, isViewModal, isEditModal, isDeleteModal, handleToggleModal, handleReset } =
    useModalHelpers()

  const moduleName = 'Client'
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
