import { ref } from 'vue'

export function useFileHandler(formData) {
  const fileName = ref({})
  const fileError = ref({})
  const fileType = ref({}) // 'image' or 'pdf'

  const handleFileChange = (event, fileKey, previewKey) => {
    const file = event.target.files[0]

    if (!file) {
      fileName.value[fileKey] = ''
      return
    }
    
    // ❌ Validate file size (1MB = 1048576 bytes)
    const maxSize = 1 * 1024 * 1024
    if (file.size > maxSize) {
      fileError.value[fileKey] =
        `File size exceeds 1MB limit. Selected file size: ${(file.size / (1024 * 1024)).toFixed(2)} MB.`
      event.target.value = null
      return
    }

    // Assign file directly
    formData[fileKey] = file
    fileName.value[fileKey] = file.name
    fileType.value[previewKey] = file.type == 'application/pdf' ? 'pdf' : 'image'
    // Handle preview
    if (previewKey) {
      formData[previewKey] = URL.createObjectURL(file)
    }
    // ❗ CRITICAL FIX: reset input so same file triggers change
    event.target.value = null
  }

  const cancelImage = (cancelKey) => {
    const fileKey = cancelKey.concat('_file')
    const previewKey = cancelKey.concat('_preview')
    formData[fileKey] = null
    formData[previewKey] = null
    fileName.value[fileKey] = ''
  }

  return { handleFileChange, fileName, fileError, cancelImage, fileType }
}
