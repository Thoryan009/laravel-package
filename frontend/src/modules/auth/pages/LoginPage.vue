<template>
  <AuthLayout>
    <!-- Logo / Title -->
    <div class="text-center mb-8">
      <AuthTitle>{{ app.name }}</AuthTitle>
      <AuthSubTitle>Please sign in to continue</AuthSubTitle>
    </div>
    <!-- Form -->
    <form @submit.prevent="handleSubmit" class="space-y-6">
      <!-- Email -->
      <div>
        <BaseLabel for="email">Email Address</BaseLabel>
        <BaseInput id="email" v-model="formData.email" type="email" placeholder="admin@example.com" />
      </div>

      <!-- Password -->
      <BasePasswordInput v-model="formData.password" />


      <!-- Submit -->
      <AuthButton :disabled="loginLoading">
        <span v-if="loginLoading">Logging in...</span>
        <span v-else>Login</span>
      </AuthButton>

      <BaseTable :columns="columns" :rows="loginData" show-actions v-if="app.moduleLocal">
        <template #actions="{ row }">
          <BaseButton @click="handleSubmit(row.role)">
            Login
          </BaseButton>
        </template>
      </BaseTable>

      <!-- Error -->
      <p v-if="loginError" class="text-center text-sm text-red-600">{{ loginError.message }}</p>

      <!-- Forgot Password -->
      <div class="text-center text-sm text-gray-600">
        Forgot your password?
        <router-link to="/forgot-password" class="text-blue-600 font-semibold hover:underline ml-1">Click
          here</router-link>
      </div>
    </form>
  </AuthLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../store/authStore'
import { useRouter, useRoute } from 'vue-router'
import AuthTitle from '../shared/components/ui/AuthTitle.vue'
import AuthSubTitle from '../shared/components/ui/AuthSubTitle.vue'
import AuthButton from '../shared/components/ui/AuthButton.vue'
import AuthLayout from '../shared/components/layout/AuthLayout.vue'
import BaseLabel from '@/shared/components/base/BaseLabel.vue'
import BaseInput from '@/shared/components/base/BaseInput.vue'
import { useAuthMutations } from '../queries/useAuthMutations'
import app from '@/shared/config/appConfig'
import { onMounted } from 'vue'
import { toast } from '@/shared/config/toastConfig'
import { useCrudTable } from '@/shared/composables/useCrudTable'
import loginData from '../data/loginData'

const store = useAuthStore()
const router = useRouter()
const route = useRoute()

const formData = ref({
  email: app.moduleLocal ? 'admin@example.com' : '',
  password: app.moduleLocal ? '12345678' : '',
})


const { login, loginLoading, loginError } = useAuthMutations(store.moduleName, {
  onSuccess(data) {
    if (data?.success && data?.token) {
      localStorage.setItem(app.tokenKey, data.token)
      localStorage.setItem(app.userRoleKey, data.role)
      router.push({ name: 'Dashboard' })
    }
  },
})

const { columns } = useCrudTable(store, [
  { key: 'name', label: 'Name' },
  { key: 'role', label: 'Role' },
], { timestamps: false, trackUser: false });




onMounted(() => {
  if (route.query.unauthorized) {
    // 🔔 Show warning (replace with toast/snackbar)
    toast.warning('Your session has expired. Please log in again.')
    // Optional: clean URL
    router.replace({ name: 'Login' })
  }
})

const handleSubmit = async (role = null) => {
  if (role) {
    const user = loginData.find(item => item.role === role)

    if (user) {
      formData.value.email = user.email
      formData.value.password = user.password
    }
  }

  await login.mutateAsync(formData.value)
}
</script>
