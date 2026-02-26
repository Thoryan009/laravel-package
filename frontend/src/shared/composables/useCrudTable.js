export function useCrudTable(store, fields = [], options = {}) {
  const { timestamps = true, trackUser = true } = options

  const columns = [{ key: 'sl', label: 'SL' }, ...fields]

  if (timestamps) {
    columns.push(
      { key: 'created_at', label: 'Created At' },
      { key: 'updated_at', label: 'Updated At' },
    )
  }

  if(trackUser){
    columns.push(
      { key: 'created_by', label: 'Created By' },
      { key: 'updated_by', label: 'Updated By' },
    )
  }

  const onView = (row) => store.handleToggleModal('view', row)
  const onEdit = (row) => store.handleToggleModal('edit', row)
  const onDelete = (row) => store.handleToggleModal('delete', row)

  return {
    columns,
    onView,
    onEdit,
    onDelete,
  }
}
