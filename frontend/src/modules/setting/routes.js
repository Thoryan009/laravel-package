import SettingPage from './pages/SettingPage.vue'
import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'

export default [
  {
    path: '/settings',
    component: DashboardLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'Setting',
        component: SettingPage,
      },
    ],
  },
]
