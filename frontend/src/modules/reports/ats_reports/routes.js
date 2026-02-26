import DashboardLayout from '@/shared/layouts/DashboardLayout.vue'
import AtsReportsPage from './pages/AtsReportsPage.vue'
import ATSReportPage from './pages/ATSReportPage.vue'
import AtsReportPrintPage from './pages/AtsReportPrintPage.vue'

export default [
  {
    path: '/ats-reports',
    component: DashboardLayout,
    meta: { requiresAuth: true, roles: ['super_admin', 'admin', 'recruiter'] },
    children: [
      {
        path: '',
        name: 'ATS Reports',
        component: AtsReportsPage,
      },
      {
        path: ':type',
        name: 'ATS Report',
        component: ATSReportPage,
      },
    ],
  },
  {
      path: '/ats-reports/:type/print',
      name: 'ATS Report Print',
      component: AtsReportPrintPage,
      meta: { requiresAuth: true, roles: ['super_admin','admin', 'recruiter'] },
    },
]
