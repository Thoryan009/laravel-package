import { ref } from 'vue'

export function useModalHelpers() {
  const item = ref(null)

  const isModal = ref(false)
  const isViewModal = ref(false)
  const isEditModal = ref(false)
  const isDeleteModal = ref(false)

  function resetModals() {
    isModal.value = false
    isViewModal.value = false
    isEditModal.value = false
    isDeleteModal.value = false
  }

  function handleToggleModal(type, selectedItem = null) {
    item.value = selectedItem
    resetModals()

    if (type === 'add') isModal.value = true
    else if (type === 'view') isViewModal.value = true
    else if (type === 'edit') isEditModal.value = true
    else if (type === 'delete') isDeleteModal.value = true
  }

  function handleReset(payload) {
    Object.keys(payload).forEach((key) => {
      payload[key] = ''
    })
  }

  return {
    // state
    item,
    isModal,
    isViewModal,
    isEditModal,
    isDeleteModal,

    // actions
    handleToggleModal,
    handleReset,
    resetModals,
  }
}
