import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'
import DashboardPage from './pages/DashboardPage.vue'

export default [
  {
    path: '/dashboard',
    component: DashboardLayout,
    meta: { requiresAuth: true, roles: ['super_admin','admin','recruiter', 'accountant'] },
    children: [
      {
        path: '',
        name: 'Dashboard',
        component: DashboardPage,
      },
    ],
  },
]
