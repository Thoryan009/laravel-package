import ClientPage from './pages/ClientPage.vue'
import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'

export default [
  {
    path: '/clients',
    component: DashboardLayout,
    meta: { requiresAuth: true, roles: ['super_admin','admin','recruiter'] },
    children: [
      {
        path: '',
        name: 'Client List',
        component: ClientPage,
      },
    ],
  },
]
