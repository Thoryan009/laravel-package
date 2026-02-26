import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'
import ApplicationReportsPage from './pages/ApplicationReportsPage.vue'
import ApplicationReportPage from './pages/ApplicationReportPage.vue'
import ApplicationReportPrintPage from './pages/ApplicationReportPrintPage.vue'

export default [
  {
    path: '/application-reports',
    component: DashboardLayout,
    meta: { requiresAuth: true, roles: ['super_admin', 'admin', 'recruiter'] },
    children: [
      {
        path: '',
        name: 'Worker Reports',
        component: ApplicationReportsPage,
      },
      {
        path: ':type',
        name: 'Worker Report',
        component: ApplicationReportPage,
      },
    ],
  },
  {
      path: '/application-reports/:type/print',
      name: 'Worker Report Print',
      component: ApplicationReportPrintPage,
      meta: { requiresAuth: true, roles: ['super_admin','admin', 'recruiter'] },
    },
]
