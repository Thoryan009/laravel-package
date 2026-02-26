import CountryPage from './pages/CountryPage.vue'
import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'

export default [
  {
    path: '/countries',
    component: DashboardLayout,
    meta: { requiresAuth: true, roles: ['super_admin','admin','recruiter'] },
    children: [
      {
        path: '',
        name: 'Country List',
        component: CountryPage,
      },
    ],
  },
]
